<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

use DateTime;

class OrderStatusHistoryItemDTO
{
    public function __construct(
        public readonly DateTime $dateTime,
        public readonly int $unixDateTime,
        public readonly OrderStatusHistoryItemStatusTextParts $statusTextParts,
        public readonly OrderStatusHistoryItemComment $comment,
        public readonly int $code,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            dateTime: new DateTime($data['dateTime']),
            unixDateTime: $data['unixDateTime'],
            statusTextParts: OrderStatusHistoryItemStatusTextParts::fromArray($data['statusTextParts']),
            comment: OrderStatusHistoryItemComment::fromArray($data['comment']),
            code: $data['code'],
        );
    }

    public function toArray(): array
    {
        return [
            'dateTime' => $this->dateTime->format('Y-m-d H:i:s'),
            'unixDateTime' => $this->unixDateTime,
            'statusTextParts' => $this->statusTextParts->toArray(),
            'comment' => $this->comment->toArray(),
            'code' => $this->code,
        ];
    }
}
