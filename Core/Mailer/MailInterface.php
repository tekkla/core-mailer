<?php
namespace Core\Mailer;

/**
 * MailInterface.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
interface MailInterface
{

    /**
     * Returns subject text
     *
     * @return string
     */
    public function getSubject(): string;

    /**
     * Sets subject text
     *
     * @param string $subject
     *            The subject text
     */
    public function setSubject(string $subject);

    /**
     * Returns set body content
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Sets mail body content
     *
     * @param string $body
     *            The body content
     */
    public function setBody(string $body);

    /**
     * Returns set altbody content
     *
     * @return string
     */
    public function getAltbody(): string;

    /**
     * Sets altbody content for non html capable mail clients when mail is html
     *
     * @param string $altbody
     *            The altbody content
     */
    public function setAltbody(string $altbody);

    /**
     * Returns all added attachements
     *
     * @return array
     */
    public function getAttachements(): array;

    /**
     * Adds an attachement
     *
     * @param string $attachement
     *            Full path to attachement
     * @param string $name
     *            Optional title (Default: '')
     * @param string $encoding
     *            Optional encoding (Default: 'base64')
     * @param strng $type
     *            Optional attachement type (Default: 'application/octet-stream')
     */
    public function addAttachment(string $path, string $name = '', string $encoding = 'base64', string $type = 'application/octet-stream');

    /**
     * Removes all attachments
     */
    public function clearAttachements();

    /**
     * Returns all embedded images
     *
     * @return array
     */
    public function getEmbeddedImages(): array;

    /**
     * Adds an embedded image
     *
     * @param string $path
     *            Full path to image
     * @param string $cid
     *            Content id of image
     * @param string $name
     *            Optional title (Default: '')
     * @param string $encoding
     *            Optional encoding (Default: 'base64')
     * @param strng $type
     *            Optional attachement type (Default: 'application/octet-stream')
     */
    public function addEmbeddedImage(string $path, string $cid, string $name = '', string $encoding = 'base64', string $type = 'application/octet-stream');

    /**
     * Removes all embeded images
     */
    public function clearEmbeddedImages();

    /**
     * Sets or returns html flag
     *
     * @param boolean $flag
     *            Optional boolean flag
     */
    public function isHtml(bool $flag = null): bool;

    /**
     * Returns charset
     *
     * @return string
     */
    public function getCharset(): string;

    /**
     * Sets charset
     *
     * @param string $charset
     */
    public function setCharset(string $charset);

    /**
     * Returns from mailaddress and name
     *
     * @return array
     */
    public function getFrom(): array;

    /**
     * Set from and optional fromname property
     *
     * @param string $from
     *            The 'from' mailaddress
     * @param string $fromname
     *            Optional name the mail is from
     */
    public function setFrom(string $from, string $name = '');

    /**
     * Returns the fromname
     *
     * @return string
     */
    public function getFromName(): string;

    /**
     * Set the fromname
     *
     * @param string $name
     */
    public function setFromName(string $name);

    /**
     * Adds one replyto contact to the replytolist
     *
     * @param string $mailaddress
     *            Contact reply to mailaddress
     *
     * @param string $name
     *            Optional contact replyto name
     */
    public function addReplyto(string $mailaddress, string $name = '');

    /**
     * Returns replyto stack
     *
     * @return array
     */
    public function getReplyto(): array;

    /**
     * Adds one recipient to the recipientlist
     *
     * @param string $type
     *            Recipient type like 'to', 'cc' or 'bcc'
     * @param string $recipient
     *            Recipients mailaddress
     * @param string $name
     *            Optional recipients name
     *
     * @throws MailException when no valid type should be used
     */
    public function addRecipient(string $type, string $recipient, string $name = '');

    /**
     * Returns recipientlist
     *
     * @return array
     */
    public function getRecipients(): array;

    /**
     * Clears recipientlist
     */
    public function clearRecipients();

    /**
     * Adds a recipient with optional name to recipients "to" list
     *
     * @param string $address
     *            Mailaddress to add to TO recipientlist
     * @param string $name
     *            Optional name for recipient
     */
    public function addTo(string $address, string $name = '');

    /**
     * Clears "to" recipientlist
     */
    public function clearTo();

    /**
     * Adds a recipient with optional name to recipients "cc" list
     *
     * @param string $cc
     *            Mailaddress to add
     * @param string $name
     *            Optional name for recipient
     */
    public function addCc(string $address, string $name = '');

    /**
     * Clears "cc" recipientlist
     */
    public function clearCc();

    /**
     * Adds a recipient with optional name to recipients "bcc" list
     *
     * @param string $address
     *            Mailaddress to add
     * @param string $name
     *            Optional name for recipient
     */
    public function addBcc(string $address, string $name = '');

    /**
     * Clears "bcc" recipientlist
     */
    public function clearBcc();

    /**
     * Set mail encoding
     *
     * @param string $encoding
     *            Encoding type
     */
    public function setEncoding(string $encoding);

    /**
     * Returns encoding type
     */
    public function getEncoding(): string;

    /**
     * Sets mailaddress to which a reading confirm message should be sent
     *
     * @param string $mailadress
     *            Mailaddress to send confirmmail to
     */
    public function setConfirmReadingTo(string $mailadress);

    /**
     * Returns set mailaddress to which a confirm message should be sent
     *
     * @return string
     */
    public function getConfirmReadingTo(): string;

    /**
     * Adds custom header with optional value
     *
     * @param string $header
     *            custom header string
     * @param string $value
     *            Optional header value
     */
    public function addHeader(string $header, string $value = '');

    /**
     * Returns set headers
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Cleans headers
     */
    public function cleanHeaders();

    /**
     * Returns mail priority
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * Sets mail priority
     *
     * Proves priority to be between 1 (high) and 5 (low).
     *
     * @param int $priority
     *            The mail priority value. Has to be between 1 (high) to 5 (low)
     *
     * @throws MailerException when priority to be set is out of bounds.
     */
    public function setPriority(int $priority);

    /**
     * Returns the set id of the registered MTA
     *
     * @throws MailException when no mta id is set
     *
     * @return string
     */
    public function getMta(): string;

    /**
     * Id of the MTA to use for sending mail
     *
     * @param string $id
     *            The id of registered MTA to use for sending this mail
     */
    public function setMta(string $id);
}

