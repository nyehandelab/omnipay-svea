<?php
declare(strict_types=1);

namespace Nyehandel\Omnipay\Svea\Message;

use Omnipay\Common\Message\RequestInterface;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    protected $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data);
        $this->statusCode = $statusCode;
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        return $this->statusCode;
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->data['error_message'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function isSuccessful(): bool
    {
        return $this->getCode() < 400;
    }
}

