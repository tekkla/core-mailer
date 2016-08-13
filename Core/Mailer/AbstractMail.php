<?php
namespace Core\Mailer;

/**
 * AbstractMail.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
abstract class AbstractMail implements MailInterface
{

    /**
     *
     * @var string
     */
    protected $subject = '';

    /**
     *
     * @var string
     */
    protected $body = '';

    /**
     *
     * @var string
     */
    protected $altbody = '';

    /**
     *
     * @var array
     */
    protected $attachements = [];

    /**
     *
     * @var array
     */
    protected $images = [];

    /**
     *
     * @var boolean
     */
    protected $html = false;

    /**
     *
     * @var string
     */
    protected $charset = 'UTF-8';

    /**
     *
     * @var string
     */
    protected $encoding = '8bit';

    /**
     *
     * @var string
     */
    protected $from = '';

    /**
     *
     * @var string
     */
    protected $fromname = '';

    /**
     *
     * @var string
     */
    protected $sender = '';

    protected $replyto = [];

    /**
     *
     * @var array
     */
    protected $recipients = [
        'to' => [],
        'cc' => [],
        'bcc' => []
    ];

    /**
     *
     * @var string
     */
    protected $confirm_reading_to = '';

    /**
     *
     * @var int
     */
    protected $priority = 3;

    /**
     *
     * @var array
     */
    protected $headers = [];

    /**
     *
     * @var string
     */
    protected $mta = '';

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getSubject()
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setSubject($subject)
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getBody()
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setBody($body)
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getAltbody()
     */
    public function getAltbody(): string
    {
        return $this->altbody;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setAltbody($altbody)
     */
    public function setAltbody(string $altbody)
    {
        $this->altbody = $altbody;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getAttachements()
     */
    public function getAttachements(): array
    {
        return $this->attachements;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addAttachment($path, $name, $encoding, $type)
     */
    public function addAttachment(string $path, string $name = '', string $encoding = 'base64', string $type = 'application/octet-stream')
    {
        $this->attachements[] = [
            'path' => $path,
            'name' => $name,
            'encoding' => $encoding,
            'type' => $type
        ];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::clearAttachements()
     */
    public function clearAttachements()
    {
        $this->attachements = [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getEmbeddedImages()
     */
    public function getEmbeddedImages(): array
    {
        return $this->images;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addEmbeddedImage($path, $cid, $name, $encoding, $type)
     */
    public function addEmbeddedImage(string $path, string $cid, string $name = '', string $encoding = 'base64', string $type = 'application/octet-stream')
    {
        $this->images[] = [
            'path' => $path,
            'cid' => $cid,
            'name' => $name,
            'encoding' => $encoding,
            'type' => $type
        ];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::clearEmbeddedImages()
     */
    public function clearEmbeddedImages()
    {
        $this->images = [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::isHtml($flag)
     */
    public function isHtml(bool $flag = null): bool
    {
        if (empty($flag)) {
            return $this->html;
        }

        $this->html = (bool) $flag;

        return $flag;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getCharset()
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setCharset($charset)
     */
    public function setCharset(string $charset)
    {
        $this->charset = $charset;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getFrom()
     */
    public function getFrom(): array
    {
        return [
            'from' => $this->from,
            'name' => $this->fromname,
        ];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setFrom($from, $name)
     */
    public function setFrom(string $from, string $name = '')
    {
        $this->from = $from;

        if ($name) {
            $this->fromname = $name;
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getFromName()
     */
    public function getFromName(): string
    {
        return $this->fromname;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setFromName($name)
     */
    public function setFromName(string $name)
    {
        $this->fromname = $name;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addReplyto($mailaddress, $name)
     */
    public function addReplyto(string $mailaddress, string $name = '')
    {
        $this->replyto[$mailaddress] = $name;
    }

    /**
     * Adds a list of contacts to the replytolist
     *
     * @param array $reply_tos
     *            List of contacts to add. This array can be an indexed array with only
     *            the contacts mailaddress or an assoc array with mailaddress as key and
     *            the contacts name as value.
     */
    public function addReplytos(array $reply_tos)
    {
        foreach ($reply_tos as $key => $val) {
            if (is_numeric($key)) {
                $this->addReplyto($val);
            }
            else {
                $this->addReplyto($key, $val);
            }
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getReplyto()
     */
    public function getReplyto(): array
    {
        return $this->replyto;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addRecipient($type, $recipient, $name)
     */
    public function addRecipient(string $type, string $recipient, string $name = '')
    {
        $types = [
            'to',
            'cc',
            'bcc'
        ];

        if (!in_array($type, $types)) {
            Throw new MailException(sprintf('The recipienttype "%" is not allowed. Please select from "to", "cc" or "bcc"'), $type);
        }

        $this->recipients[$type][$recipient] = $name;
    }

    /**
     * Adds a list of recipients to the recipientslist
     *
     * @param string $type
     *            Name of the list to add the recipients. Can be "to", "cc" or "bcc".
     * @param array $recipients
     *            List of recipients to add. This array can be an indexed array with only
     *            the recipients mailaddress or an assoc array with mailaddress as key and
     *            the recipients name as value.
     *
     * @throws MailException when no valid type should be used
     */
    public function addRecipients(string $type, array $recipients)
    {
        $types = [
            'to',
            'cc',
            'bcc'
        ];

        if (!in_array($type, $types)) {
            Throw new MailException(sprintf('The recipienttype "%" is not allowed. Please select from "to", "cc" or "bcc"'), $type);
        }

        foreach ($recipients as $key => $val) {
            if (is_numeric($key)) {
                $this->addRecipient($type, $val);
            }
            else {
                $this->addRecipient($type, $key, $val);
            }
        }
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getRecipients()
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::clearRecipients()
     */
    public function clearRecipients()
    {
        $this->recipients = [
            'to' => [],
            'cc' => [],
            'bcc' => []
        ];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addTo($address, $name)
     */
    public function addTo(string $address, string $name = '')
    {
        $this->addRecipient('to', $address, $name);
    }

    /**
     * Adds a arraylist of recipients to recipients "to" list.
     *
     * Works similiar to addRecipients() method.
     *
     * @param array $tos
     *            List of recipients to add. This array can be an indexed array with only
     *            the recipients mailaddress or an assoc array with mailaddress as key and
     *            the recipients name as value.
     */
    public function addTos(array $tos)
    {
        $this->addRecipients('to', $tos);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::clearTo()
     */
    public function clearTo()
    {
        $this->recipients['to'] = [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addCc($address, $name)
     */
    public function addCc(string $address, string $name = '')
    {
        $this->addRecipient('cc', $address, $name);
    }

    /**
     * Adds a arraylist of recipients to recipients "cc" list.
     *
     * Works similiar to addRecipients() method.
     *
     * @param array $ccs
     *            List of recipients to add. This array can be an indexed array with only
     *            the recipients mailaddress or an assoc array with mailaddress as key and
     *            the recipients name as value.
     */
    public function addCcs(array $tos)
    {
        $this->addRecipients('cc', $tos);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::clearCc()
     */
    public function clearCc()
    {
        $this->recipients['cc'] = [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addBcc($address, $name)
     */
    public function addBcc(string $address, string $name = '')
    {
        $this->addRecipient('bcc', $address, $name);
    }

    /**
     * Adds a arraylist of recipients to recipients "bcc" list.
     *
     * Works similiar to addRecipients() method.
     *
     * @param array $bccs
     *            List of recipients to add. This array can be an indexed array with only
     *            the recipients mailaddress or an assoc array with mailaddress as key and
     *            the recipients name as value.
     */
    public function addBcs(array $tos)
    {
        $this->addRecipients('bcc', $tos);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::clearBcc()
     */
    public function clearBcc()
    {
        $this->recipients['bcc'] = [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setEncoding($encoding)
     */
    public function setEncoding(string $encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getEncoding()
     */
    public function getEncoding(): string
    {
        return $this->encoding;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setConfirmReadingTo($mailadress)
     */
    public function setConfirmReadingTo(string $mailadress)
    {
        $this->confirm_reading_to = $mailadress;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getConfirmReadingTo()
     */
    public function getConfirmReadingTo(): string
    {
        return $this->confirm_reading_to;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::addHeader($header, $value)
     */
    public function addHeader(string $header, string $value = '')
    {
        $this->headers[$header] = $value;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getHeaders()
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::cleanHeaders()
     */
    public function cleanHeaders()
    {
        $this->headers = [];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getPriority()
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setPriority($priority)
     */
    public function setPriority(int $priority)
    {
        if ($priority < 1 || $priority > 5) {
            Throw new MailException('Mail priority has to be betwenn 1 (high) to 5 (low)');
        }

        $this->priority = $priority;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::getMta()
     */
    public function getMta(): string
    {
        if (!$this->mta) {
            Throw new MailException('No MTA id set.');
        }

        return $this->mta;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MailInterface::setMta($id)
     */
    public function setMta(string $id)
    {
        $this->mta = $id;
    }
}

