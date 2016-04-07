<?php

namespace Noah\Library\Models;

use Site;
use Illuminate\Mail\Mailer as BaseMailer;

class Mailer {

    /**
     * @var BaseMailer
     */
    protected $mailer;

    /**
     * Mailer constructor.
     */
    public function __construct(BaseMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Get the prefix to prepend at the subject.
     *
     * @return string
     * @author Cali
     */
    public static function subjectPrefix()
    {
        return '【' . Site::siteTitle() . '】';
    }
}