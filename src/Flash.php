<?php

namespace DPWebSolutions\LaravelFlash;

class Flash
{
    protected string $type;
    protected ?string $message;
    protected ?bool $now;

    protected function __construct(?string $message = null, ?bool $now = false)
    {
        $this->message = $message;
        $this->now = $now;

        $this->putFlash('success');
    }

    /**
     * Return a new static instance of this class.
     *
     * @return static
     */
    public static function instance(?string $message = null)
    {
        return new static($message);
    }

    public function now(?bool $now = true)
    {
        $this->now = $now;

        return $this;
    }

    /**
     * Flash a new "success" message.
     *
     * @return $this
     */
    public function success(?string $message = null)
    {
        return $this->putTyped('success', $message);
    }

    /**
     * Flash a new "error" message.
     *
     * @return $this
     */
    public function error(?string $message = null)
    {
        return $this->putTyped('error', $message);
    }

    /**
     * Flash a new "warning" message.
     *
     * @return $this
     */
    public function warning(?string $message = null)
    {
        return $this->putTyped('warning', $message);
    }

    /**
     * Flash a new "stored" message.
     *
     * @return $this
     */
    public function stored(?string $message = null)
    {
        return $this->putTyped('stored', $message);
    }

    /**
     * Flash a new "updated" message.
     *
     * @return $this
     */
    public function updated(?string $message = null)
    {
        return $this->putTyped('updated', $message);
    }

    /**
     * Flash a new "deleted" message.
     *
     * @return $this
     */
    public function deleted(?string $message = null)
    {
        return $this->putTyped('deleted', $message);
    }

    /**
     * Flash a new "queued" message.
     *
     * @return $this
     */
    public function queued(?string $message = null)
    {
        return $this->putTyped('queued', $message);
    }

    public function dismissible(?bool $dismissible = true)
    {
        $notifications = session()->get($this->key());

        if (empty($notifications)) {
            return;
        }

        $index = count($notifications) - 1;

        $notifications = $this->notifications();
        $notifications[$index]['dismissible'] = $dismissible;

        $this->flash($notifications);
    }

    /**
     * The class applied to the flash notification type.
     */
    public function getNotificationClass(): string
    {
        return config("flash.classes.{$this->framework()}.{$this->type}") ?? 'success';
    }

    public static function framework(): string
    {
        return config('flash.framework') ?? 'tailwind';
    }

    /**
     * Put a new flash message with "$type" key.
     *
     * @return $this
     */
    protected function putTyped(string $type, ?string $message = null)
    {
        // Delete last, empty notification
        $notifications = $this->notifications();
        $last = array_pop($notifications);
        if (!empty($last) && is_null($last['message'])) {
            $this->flash($notifications);
        }

        return $this->putFlash($type, $message ?? config("flash.messages.{$type}"));
    }

    /**
     * Put a new flash message with "$type" key.
     *
     * @return $this
     */
    protected function putFlash(string $type, ?string $message = null)
    {
        $this->type = $type;

        $this->message = $this->message ?? $message;

        $notifications = $this->notifications() ?? [];

        $notifications[] = [
            'type' => $this->type,
            'class' => $this->getNotificationClass(),
            'message' => $this->message,
            'dismissible' => config('flash.dismissible'),
        ];

        $this->flash($notifications);

        return $this;
    }

    protected function key()
    {
        return config('flash.session_key');
    }

    protected function flash(array $notifications)
    {
        if ($this->now) {
            session()->now($this->key(), $notifications);
        } else {
            session()->flash($this->key(), $notifications);
        }
    }

    protected function notifications()
    {
        return session($this->key());
    }
}
