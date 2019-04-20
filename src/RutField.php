<?php

namespace Freshwork\RutField;

use Freshwork\ChileanBundle\Rut;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class RutField extends Field
{
  /**
   * The field's component.
   *
   * @var string
   */
  public $component = 'rut-field';

  protected $saveNormalized = true;

  public function format($format)
  {
    return $this->withMeta(['format' => $format]);
  }

  public function formatComplete()
  {
    return $this->format(Rut::FORMAT_COMPLETE);
  }

  public function formatWithDash()
  {
    return $this->format(Rut::FORMAT_WITH_DASH);
  }

  public function formatEscaped()
  {
    return $this->format(Rut::FORMAT_ESCAPED);
  }

  public function formatOnBlur()
  {
    return $this->withMeta(['formatOn' => 'blur']);
  }

  public function saveWithoutNormalization()
  {
    $this->saveNormalized = false;

    return $this->withMeta(['saveNormalized' => 'false']);
  }

  /**
   * Hydrate the given attribute on the model based on the incoming request.
   *
   * @param  \Laravel\Nova\Http\Requests\NovaRequest $request
   * @param  string $requestAttribute
   * @param  object $model
   * @param  string $attribute
   * @return void
   * @throws \Freshwork\ChileanBundle\Exceptions\InvalidFormatException
   */
  protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
  {
    if (isset($request[$requestAttribute]) && $this->saveNormalized) {
      return $model->{$attribute} = Rut::parse($request[$requestAttribute])->quiet()->normalize();
    }
    $model->{$attribute} = $request[$requestAttribute];
  }
}
