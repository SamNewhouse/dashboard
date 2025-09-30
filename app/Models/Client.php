<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Relaticle\CustomFields\Models\Contracts\HasCustomFields;
use Relaticle\CustomFields\Models\Concerns\UsesCustomFields;

class Client extends Model implements HasCustomFields
{
  /** @use HasFactory<\Database\Factories\ClientFactory> */
  use UsesCustomFields;
  use HasFactory;

  protected $fillable = ['name', 'email', 'status'];
}
