<?php
namespace Core\Mailer;

use Psr\Log\LoggerInterface;

/**
 * MailerInterface.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
interface MailerInterface
{

    /**
     * Sets a psr/log compatible logger service
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * Registers a MTA in mailer
     *
     * @param MtaInterface $mta
     */
    public function registerMta(MtaInterface $mta);

    /**
     * Checks for the existance of a MTA
     *
     * @param string $id
     *            The id of the MTA
     *
     * @return boolean
     */
    public function checkMta(string $id): bool;

    /**
     * Returns all registered MTAs
     *
     * @return array
     */
    public function getAllMta(): array;

    /**
     * Adds a mail object to the mail queue
     *
     * @param MailInterface $mail
     *            The mail object
     */
    public function addMail(MailInterface $mail);

    /**
     * Sets SMTP debug level to get used
     *
     * @param int $debug_level
     */
    public function setDebugLevel(int $debug_level);

    /**
     * Sends all mails
     */
    public function send();
}

