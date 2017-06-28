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
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getTitle()
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getDescription()
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setDescription()
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getHost()
     */
    public function getHost(): string
    {
        return $this->host ?? '';
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setHost()
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getPort()
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setPort()
     */
    public function setPort(int $port)
    {
        $this->port = $port;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getUsername()
     */
    public function getUsername(): string
    {
        return $this->username ?? '';
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setUsername()
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getPassword()
     */
    public function getPassword(): string
    {
        return $this->password ?? '';
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setPassword()
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getSmtpSecure()
     */
    public function getSmtpSecure(): string
    {
        return $this->smtp_secure ?? '';
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setSmtpSecure()
     */
    public function setSmtpSecure(string $smtp_secure)
    {
        $types = [
            'tls',
            'ssl'
        ];

        if (! in_array($smtp_secure, $types)) {
            Throw new MtaException(sprintf('"%s" is no valid smtp secure type. Valid types are "ssl" or "tls"'), $smtp_secure);
        }

        $this->smtp_secure = $smtp_secure;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getIsDefault()
     */
    public function getIsDefault(): bool
    {
        return $this->is_default;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setIsDefault()
     */
    public function setIsDefault(bool $is_default)
    {
        $this->is_default = $is_default;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getType()
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setType()
     */
    public function setType(int $type)
    {
        $this->type = $type;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getSmtpAuth()
     */
    public function getSmtpAuth(): bool
    {
        return $this->smtp_auth;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setSmtpAuth()
     */
    public function setSmtpAuth(bool $smtp_auth)
    {
        $this->smtp_auth = $smtp_auth;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::getSmtpOptions()
     */
    public function getSmtpOptions(): array
    {
        return $this->smtp_options;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Core\Mailer\MtaInterface::setSmtpOptions()
     */
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

