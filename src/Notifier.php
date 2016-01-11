<?php

namespace Beaver\Dateval;

class Notifier extends \PHPMailer {
    
    private $event,
            $EmailTemplate;
    
    /**
     * Construct Notifier object
     * @param \Beaver\Dateval\EventBuilder $event
     * @param \Beaver\Dateval\EmailTemplate $template
     */
    public function __construct(EventBuilder $event, EmailTemplate $template) {
        $this->event = $event;
        $this->EmailTemplate = $template;
        // PHPMailer constructor
        parent::__construct();
        $this->EmailTemplate->parse($event);
    }
       
    /**
     * Send to one email
     * @param type $email
     */
    public function notify($email) {}
    
    /**
     * Send email to all emails in array
     * @param array $emails
     */
    public function notifyAll(array $emails) {
        
    }

    
    
}
