<?php

function acceptInt(int $x){
    if ($x>10){
        // throw new \Exception();

        throw new InvalidArgumentException("x must be =< than 10");
        //throw $exception;
    }
    echo "success";
}

try {
    acceptInt(30);
    echo "Hi!";
} catch (InvalidArgumentException $e) {
    echo "I can catch invalid arg exception";
} catch (Exception $e) {
    echo "I catch the exception" .$e->getMessage();;
}

//throw new \Exception();

