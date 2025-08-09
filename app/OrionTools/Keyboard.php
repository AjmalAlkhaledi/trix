<?php

namespace App\OrionTools;

class Keyboard
{
    protected string $type;
    protected array $rows = [[]]; // inline default
    protected array $options = [];

    public function __construct(string $type = 'inline')
    {
        $this->type = $type;
    }

    public static function make(string $type = 'inline'): static
    {
        return new static($type);
    }

    /**
     * Adds a button to the current row (for inline keyboard only)
     */
    public function button(
        string $text,
        ?string $callback_data = null,
        ?string $url = null,
        ?string $switch_inline_query = null,
        ?string $switch_inline_query_current_chat = null,
        ?array $login_url = null,
        ?bool $pay = null
    ): static {
        if ($this->type !== 'inline') {
            throw new \LogicException("button() is only available for 'inline' keyboards.");
        }

        $button = compact(
            'text',
            'callback_data',
            'url',
            'switch_inline_query',
            'switch_inline_query_current_chat',
            'login_url',
            'pay'
        );

        $button = array_filter($button, fn($v) => $v !== null);

        $this->rows[array_key_last($this->rows)][] = $button;

        return $this;
    }

    /**
     * Adds a new row (inline only), or full row for reply
     */
    public function row(array $buttons = []): static
    {
        if ($this->type === 'inline') {
            $this->rows[] = [];
        } elseif ($this->type === 'reply') {
            $this->rows[] = $buttons;
        }

        return $this;
    }

    /**
     * Reply keyboard options
     */
    public function resize(bool $value = true): static
    {
        if ($this->type === 'reply') {
            $this->options['resize_keyboard'] = $value;
        }
        return $this;
    }

    public function oneTime(bool $value = true): static
    {
        if ($this->type === 'reply') {
            $this->options['one_time_keyboard'] = $value;
        }
        return $this;
    }

    public function selective(bool $value = true): static
    {
        if ($this->type === 'reply') {
            $this->options['selective'] = $value;
        }
        return $this;
    }

    public function inputPlaceholder(string $text): static
    {
        if ($this->type === 'reply') {
            $this->options['input_field_placeholder'] = $text;
        }
        return $this;
    }

    /**
     * Special keyboards
     */
    public function remove(): array
    {
        return ['remove_keyboard' => true];
    }

    public function forceReply(bool $selective = false): array
    {
        return ['force_reply' => true, 'selective' => $selective];
    }

    /**
     * Final output
     */
    public function toArray(): string
    {
        return match ($this->type) {
            'inline' => json_encode(['inline_keyboard' => array_filter($this->rows)]),
            'reply'  => json_encode(array_merge(['keyboard' => array_filter($this->rows)], $this->options)),
            default  => json_encode([])
        };
    }
    
    public function get(): string
    {
        return $this->toArray();
    }
}
