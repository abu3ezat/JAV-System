<?php

namespace App;

use Foo;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function subtotal(){
        $foo = new Foo();
        $foo->subtotal();
    }
}
