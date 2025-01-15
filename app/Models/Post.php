<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body','email'];

    public function getInformationAttribute(){
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'email' => $this->email,

        ];
    }
}
