<?php
namespace Core\Mailer;

use Psr\Log\LoggerInterface;

/**
 * Mailer.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Mailer
{

    /**
     * Registered MTAs
     *
     * @var array
     */
    private $mtas = [];

    /**
     * Mail queue
     *
     * @var array
     */
    private $mails = [];

    /**
     * Cfg service
     *
     * @var Cfg
     */
    private $config;

    /**
     * Log service
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Mailer active state flag
     *
     * @var unknown
     */
    private $active = false;

    /**
     *
     * @var int
     */
    private $debug_level = 0;

    /**
     * Constructor
     */
    public function __construct()
    {}

    /**
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     *
     * @param MtaInterface $mta
     */
    public function registerMta(MtaInterface $mta)
    {
        $this->mtas[$mta->getTitle()] = $mta;
    }

    /**
     * Checks for the existance of a MTA
     *
     * @param string $id
     *            The id of the MTA
     *
     * @return boolean
     */
    public function checkMta(string $id): bool
    {
        return array_key_exists($id, $this->mtas);
    }

    /**
     * Returns all registered MTAs
     *
     * @return array
     */
    public function getAllMta(): array
    {
        return $this->mtas;
    }

    /**
     * Adds a mail object to the mail queue
     *
     * @param MailInterface $mail
     *            The mail object
     */
    public function addMail(MailInterface $mail)
    {
        $this->mails[] = $mail;
    }

    /**
     * Sends all mails
     */
    public function send()
    {
        /* @var $mail \Core\Mailer\MailInterface */
        foreach ($this->mails as $id => $mail) {

            try {

                // -----------------------------------------------
                // Handle MTA
                // -----------------------------------------------

                // Get data of MTA mapped to this mail and check for it's existance
                if (!$this->checkMta($mail->getMta())) {

                    $message = vprintf('There is no MTA with id "%s" registered. Skipping mail from "%s" to "%s" with subject "%s"', [
                        $mail->getMta(),
                        $mail->getFrom(),
                        $mail->getRecipients(),
                        $mail->getSubject()
                    ]);

                    if (isset($this->logger)) {
                        $this->logger->error($message);
                    }
                    else {
                        error_log($message);
                    }

                    unset($this->mails[$id]);
                    continue;
                }
                else {
                    /* @var $mta MtaInterface */
                    $mta = $this->mtas[$mail->getMta()];
                }

                // Create Ma
                $mailer = new \PHPMailer();

                // Get smtp debug level from config
                $mailer->SMTPDebug = $mta->getDebugLevel();

                if (!empty($mailer->SMTPDebug)) {

                    // Prepare empty array for po
                    $debug = [];

                    $mailer->Debugoutput = function ($str, $level) use (&$debug) {
                        $debug[] = $str;
                    };
                }

                // Set wthich mail system is used by the MTA
                switch ($mta->getType()) {
                    case 1:
                        $mailer->isSMTP();
                        break;

                    case 2:
                        $mailer->isQmail();
                        break;
                }

                // Connection infos
                $mailer->Host = $mta->getHost();
                $mailer->Port = $mta->getPort();
                $mailer->SMTPSecure = $mta->getSmtpSecure();

                // Userlogin
                $mailer->SMTPAuth = $mta->getSmtpAuth();

                if ($mailer->SMTPAuth) {
                    $mailer->Username = $mta->getUsername();
                    $mailer->Password = $mta->getPassword();
                }

                $mailer->SMTPOptions = $mta->getSmtpOptions();

                // -----------------------------------------------
                // Handle mail
                // -----------------------------------------------

                // Basics
                $mailer->CharSet = $mail->getCharset();
                $mailer->Encoding = $mail->getEncoding();

                // Custom headers
                $headers = $mail->getHeaders();

                foreach ($headers as $name => $value) {
                    $mailer->addCustomHeader($name, $value);
                }

                // Priority
                $mailer->Priority = $mail->getPriority();

                // Sender
                $from = $mail->getFrom();

                $mailer->setFrom($from['from'], $from['name']);

                // Reply to
                $reply_to = $mail->getReplyto();

                foreach ($reply_to as $address => $name) {
                    $mailer->addReplyTo($address, $name);
                }

                // Send confirm mail to?
                $mailer->ConfirmReadingTo = $mail->getConfirmReadingTo();

                // Recipients
                $recipients = $mail->getRecipients();

                foreach ($recipients['to'] as $address => $name) {
                    $mailer->addAddress($address, $name);
                }

                foreach ($recipients['cc'] as $address => $name) {
                    $mailer->addCC($address, $name);
                }

                foreach ($recipients['bcc'] as $address => $name) {
                    $mailer->addBCC($address, $name);
                }

                // Content
                $mailer->Subject = $mail->getSubject();
                $mailer->Body = $mail->getBody();

                if ($mail->isHtml()) {
                    $mailer->isHTML();
                    $mailer->AltBody = $mail->getAltbody();
                }

                // Attachements
                $attachements = $mail->getAttachements();

                foreach ($attachements as $a) {
                    $mailer->addAttachment($a['path'], $a['name'], $a['encoding'], $a['type']);
                }

                // Images
                $images = $mail->getEmbeddedImages();

                foreach ($images as $i) {
                    $mailer->addEmbeddedImage($i['path'], $i['cid'], $i['name'], $i['encoding'], $i['type']);
                }

                if (!$mailer->send()) {

                    // Log sned errors
                    $this->logger->error(sprintf('Mail send error: %s', $mailer->ErrorInfo));
                }
            }
            catch (\phpmailerException $e) {

                $message = 'Mailer exception caught: ' . $e->getMessage();

                if (isset($this->logger)) {
                    $this->logger->error($message);
                }
                else {
                    error_log($message);
                }
            }
            finally {

                // Any debug infos to log?
                if (!empty($debug)) {

                    $message = 'Mailer::SMTPDebug::' . $mailer->SMTPDebug . PHP_EOL . implode(PHP_EOL, $debug);

                    if (isset($this->logger)) {
                        $this->logger->debug($message);
                    }
                    else {
                        error_log($message);
                    }
                }
            }
        }
    }
}
