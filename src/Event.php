<?php

namespace Beaver\Dateval;


class Event extends EventBuilder {

    // magic set method
    public function __set($name, $value) {
        $this->$name = $value;
    }
}

