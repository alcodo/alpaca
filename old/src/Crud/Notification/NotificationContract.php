<?php

namespace Alpaca\Crud\Notification;

interface NotificationContract
{
    /**
     * Creates a store alert.
     *
     * @param bool $status
     *
     * @return void
     */
    public function store(bool $status);

    /**
     * Creates a updated alert.
     *
     * @param bool $status
     *
     * @return void
     */
    public function updated(bool $status);

    /**
     * Creates a destroy alert.
     *
     * @param bool $status
     *
     * @return void
     */
    public function destroy(bool $status);
}
