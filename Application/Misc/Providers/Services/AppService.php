<?php
use App\Contracts\DummyAppContract;
Class DummyApp implements DummyAppContract {

    public function Hello()
    {
        return 'Hello World!';
    }

}
