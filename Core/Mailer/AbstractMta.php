<?php
namespace Core\Mailer;

/**
 * AbstractMta.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
abstract class AbstractMta implements MtaInterface
{

    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @var string
     */
    private $description;

    /**
     *
     * @var
     *
     */
    private $host;

    /**
     *
     * @var int
     */
    private $port = 25;

    /**
     *
     * @var string
     */
    private $username;

    /**
     *
     * @var string
     */
    private $password;

    /**
     *
     * @var string
     */
    private $smtp_secure = 'tls';

    /**
     *
     * @var bool
     */
    private $is_default = false;

    /**
     *
     * @var bool
     */
    private $type = true;

    /**
     *
     * @var bool
     */
    private $smtp_auth = true;

    /**
     *
     * @var string
     */
    private $smtp_options;

    /**
     *
     * @var int
     */
    private $debug_level = 0;

    /**
     * Constructor
     *
     * @param string $title
     *            Title is the id which is used to identify and use this mta
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * Set the title which will be used to identify the mta
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Returns internal description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets internal descriptions
     *
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns host
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Sets host
     *
     * @param string $host
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }

    /**
     * Returns portnumber
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Sets portnumber
     *
     * @param int $port
     */
    public function setPort(int $port)
    {
        $this->port = $port;
    }

    /**
     * Returns username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Sets username
     *
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * Retruns password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets passwort
     *
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Returns smtp secure type
     *
     * @return string
     */
    public function getSmtpSecure(): string
    {
        return $this->smtp_secure;
    }

    /**
     * Sets smtp secure type
     *
     * @param bool $smtp_secure
     *
     * @throws MtaException
     */
    public function setSmtpSecure(string $smtp_secure)
    {
        $types = [
            'tls',
            'ssl'
        ];

        if (!in_array($smtp_secure, $types)) {
            Throw new MtaException(sprintf('"%s" is no valid smtp secure type. Valid types are "ssl" or "tls"'), $smtp_secure);
        }

        $this->smtp_secure = $smtp_secure;
    }

    /**
     * Returns default mta flag
     *
     * @return bool
     */
    public function getIsDefault(): bool
    {
        return $this->is_default;
    }

    /**
     * Sets default mta flag
     *
     * @param bool $is_default
     */
    public function setIsDefault(bool $is_default)
    {
        $this->is_default = $is_default;
    }

    /**
     * Returns mta type
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Sets mta type
     *
     * @param int $type
     */
    public function setType(int $type)
    {
        $this->type = $type;
    }

    /**
     * Returns smtp aut flag
     *
     * @return bool
     */
    public function getSmtpAuth(): bool
    {
        return $this->smtp_auth;
    }

    /**
     * Sets smtp auth flag
     *
     * @param bool $smtp_auth
     */
    public function setSmtpAuth(bool $smtp_auth)
    {
        $this->smtp_auth = $smtp_auth;
    }

    /**
     * Returns smtp options
     *
     * @return array
     */
    public function getSmtpOptions(): array
    {
        return $this->smtp_options;
    }

    public function setSmtpOptions(array $smtp_options)
    {
        $this->smtp_options = $smtp_options;
    }

    public function __isset($key)
    {
        return isset($this->{$key});
    }

    public function __set($key, $val)
    {
        $this->{$key} = $val;
    }

    public function __get($key)
    {
        if (isset($this->{$key})) {
            return $this->{$key};
        }
    }
}

