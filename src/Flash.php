<?php

namespace JoseGus\LaravelFlash;

class Flash
{
    protected $type;
    protected $message;

    protected function __construct($message = null)
    {
        $this->message = $message;

        $this->putFlash('success');
    }

    /**
     * Return a new static instance of this class
     *
     * @param null $message
     *
     * @return static
     */
    public static function instance($message = null)
    {
        return new static($message);
    }

    /**
     * Flash a new "success" message
     *
     * @param null $message
     *
     * @return $this
     */
    public function success($message = null)
    {
        return $this->putTyped('success', $message);
    }

    /**
     * Flash a new "error" message
     *
     * @param null $message
     *
     * @return $this
     */
    public function error($message = null)
    {
        return $this->putTyped('error', $message);
    }

    /**
     * Flash a new "warning" message
     *
     * @param null $message
     *
     * @return $this
     */
    public function warning($message = null)
    {
        return $this->putTyped('warning', $message);
    }

    /**
     * Flash a new "stored" message
     *
     * @param null $message
     *
     * @return $this
     */
    public function stored($message = null)
    {
        return $this->putTyped('stored', $message);
    }

    /**
     * Flash a new "updated" message
     *
     * @param null $message
     *
     * @return $this
     */
    public function updated($message = null)
    {
        return $this->putTyped('updated', $message);
    }

    /**
     * Flash a new "deleted" message
     *
     * @param null $message
     *
     * @return $this
     */
    public function deleted($message = null)
    {
        return $this->putTyped('deleted', $message);
    }

    /**
     * Flash a new "queued" message
     *
     * @param null $message
     *
     * @return $this
     */
    public function queued($message = null)
    {
        return $this->putTyped('queued', $message);
    }

    /**
     * @param bool $dismissible
     */
    public function dismissible($dismissible = true)
    {
        $notifications = session()->get($this->key);

        if (empty($notifications)) {
            return;
        }

        $index = count($notifications) - 1;

        $notifications = $this->notifications();
        $notifications[$index]['dismissible'] = $dismissible;

        $this->flash($notifications);
    }

    /**
     * Put a new flash message with "$type" key
     *
     * @param $type
     * @param $message
     *
     * @return $this
     */
    protected function putTyped(string $type, string $message = null)
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
     * Put a new flash message with "$type" key
     *
     * @param $type
     * @param $message
     *
     * @return $this
     */
    protected function putFlash(string $type, string $message = null)
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
        session()->now($this->key(), $notifications);
    }

    protected function notifications()
    {
        return session($this->key());
    }

    /**
     * The class applied to the flash notification type
     *
     * @return string
     */
    public function getNotificationClass(): string
    {
        return config("flash.classes.{$this->framework()}.{$this->type}") ?? 'success';
    }

    public static function framework(): string
    {
        return config('flash.framework') ?? 'tailwind';
    }
}
