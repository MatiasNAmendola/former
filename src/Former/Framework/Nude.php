<?php
namespace Former\Framework;

use Former\Interfaces\FrameworkInterface;
use Former\Traits\Field;
use Former\Traits\Framework;
use HtmlObject\Element;
use HtmlObject\Input;
use Illuminate\Container\Container;

/**
 * Base HTML5 forms
 */
class Nude extends Framework implements FrameworkInterface
{

  /**
   * The field states available
   * @var array
   */
  protected $states = array(
    'error',
  );

  /**
   * Create a new Nude instance
   *
   * @param Container $app
   */
  public function __construct(Container $app)
  {
    $this->app = $app;
  }

  ////////////////////////////////////////////////////////////////////
  /////////////////////////// FILTER ARRAYS //////////////////////////
  ////////////////////////////////////////////////////////////////////

  public function filterButtonClasses($classes)
  {
    return $classes;
  }

  public function filterFieldClasses($classes)
  {
    return $classes;
  }

  ////////////////////////////////////////////////////////////////////
  ///////////////////////////// ADD CLASSES //////////////////////////
  ////////////////////////////////////////////////////////////////////

  public function getFieldClasses(Field $field, $classes = array())
  {
    $classes = $this->filterFieldClasses($classes);

    // If we found any class, add them
    if ($classes) {
      $field->class(implode(' ', $classes));
    }

    return $field;
  }

  public function getGroupClasses()
  {
    return null;
  }

  public function getLabelClasses()
  {
    return null;
  }

  public function getUneditableClasses()
  {
    return null;
  }

  public function getFormClasses($type)
  {
    return null;
  }

  public function getActionClasses()
  {
    return null;
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// RENDER BLOCKS /////////////////////////
  ////////////////////////////////////////////////////////////////////

  /**
   * Create an help text
   */
  public function createHelp($text, $attributes = array())
  {
    return Element::create('span', $text, $attributes)->addClass('help');
  }

  /**
   * Creates a basic icon
   */
  public function createIcon($icon, $attributes = array())
  {
    return Element::create('i', null, $attributes)->addClass($icon);
  }

  /**
   * Render a disabled field
   *
   * @param Field $field
   *
   * @return string
   */
  public function createDisabledField(Field $field)
  {
    $field->disabled();

    return Input::create('text', $field->getName(), $field->getValue(), $field->getAttributes());
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// WRAP BLOCKS ///////////////////////////
  ////////////////////////////////////////////////////////////////////

  /**
   * Wrap an item to be prepended or appended to the current field
   *
   * @param  string $item
   *
   * @return string A wrapped item
   */
  public function placeAround($item)
  {
    return Element::create('span', $item);
  }

  /**
   * Wrap a field with prepended and appended items
   *
   * @param  Field $field
   * @param  array $prepend
   * @param  array $append
   *
   * @return string A field concatented with prepended and/or appended items
   */
  public function prependAppend($field, $prepend, $append)
  {
    $return = '<div>';
      $return .= join(null, $prepend);
      $return .= $field->render();
      $return .= join(null, $append);
    $return .= '</div>';

    return $return;
  }

  public function wrapField($field)
  {
    return $field;
  }
}
