<?php
namespace Core\Mailer;

/**
 * MtaInterface.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
interface MtaInterface
{

    const SECURE_SSL = 'ssl';

    const SECURE_TLS = 'tls';

    /**
     * Constructor
     *
     * @param string $title
     *            Title is the id which is used to identify and use this mta
     */
    public function __construct(string $title);

    /**
     * Set the title which will be used to identify the mta
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Returns internal description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Sets internal descriptions
     *
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * Returns host
     *
     * @return string
     */
    public function getHost(): string;

    /**
     * Sets host
     *
     * @param string $host
     */
    public function setHost(string $host);

    /**
     * Returns portnumber
     *
     * @return int
     */
    public function getPort(): int;

    /**
     * Sets portnumber
     *
     * @param int $port
     */
    public function setPort(int $port);

    /**
     * Returns username
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Sets username
     *
     * @param string $username
     */
    public function setUsername(string $username);

    /**
     * Retruns password
     *
     * @return string
     */
    public function getPassword(): string;

    /**
     * Sets password
     *
     * @param string $password
     */
    public function setPassword(string $password);

    /**
     * Returns smtp secure type
     *
     * @return string
     */
    public function getSmtpSecure(): string;

    /**
     * Sets smtp secure type
     *
     * @param bool $smtp_secure
     *
     * @throws MtaException
     */
    public function setSmtpSecure(string $smtp_secure);

    /**
     * Returns default mta flag
     *
     * @return bool
     */
    public function getIsDefault(): bool;

    /**
     * Sets default mta flag
     *
     * @param bool $is_default
     */
    public function setIsDefault(bool $is_default);

    /**
     * Returns mta type
     *
     * @return int
     */
    public function getType(): int;

    /**
     * Sets mta type
     *
     * @param int $type
     */
    public function setType(int $type);

    /**
     * Returns smtp aut flag
     *
     * @return bool
     */
    public function getSmtpAuth(): bool;

    /**
     * Sets smtp auth flag
     *
     * @param bool $smtp_auth
     */
    public function setSmtpAuth(bool $smtp_auth);

    /**
     * Returns smtp options
     *
     * @return array
     */
    public function getSmtpOptions(): array;

    /**
     * Sets smtp options
     *
     * @param array $smtp_options
     */
    public function setSmtpOptions(array $smtp_options);
}

