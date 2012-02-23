<?php


function niceforms_form_tag($url_for_options = '', $options = array())
{
  load_niceforms_theme();
  
  $options = _parse_attributes($options);

  $html_options = $options;
  
  $html_options['class'] = 'niceform';

  $html_options['method'] = isset($html_options['method']) ? strtolower($html_options['method']) : 'post';

  if (_get_option($html_options, 'multipart'))
  {
    $html_options['enctype'] = 'multipart/form-data';
  }

  $html_options['action'] = url_for($url_for_options);

  $html = '';
  if (!in_array($html_options['method'], array('get', 'post')))
  {
    $html = tag('input', array('type' => 'hidden', 'name' => 'sf_method', 'value' => $html_options['method']));
    $html_options['method'] = 'post';
  }

  return tag('form', $html_options, true).$html;
}

function load_niceforms_theme()
{
  $niceforms_theme = sfConfig::get('app_niceforms_theme');
  
  switch($niceforms_theme)
  {
    case 'default':
      sfContext::getInstance()->getResponse()->addJavascript('/sfNiceformsPlugin/js/default/niceforms');
      sfContext::getInstance()->getResponse()->addStylesheet('/sfNiceformsPlugin/css/default/niceforms');
    break;
    case 'custom':
      sfContext::getInstance()->getResponse()->addJavascript('/sfNiceformsPlugin/js/custom/niceforms');
      sfContext::getInstance()->getResponse()->addStylesheet('/sfNiceformsPlugin/css/custom/niceforms');
    break;
    default:
      sfContext::getInstance()->getResponse()->addJavascript('/sfNiceformsPlugin/js/default/niceforms');
      sfContext::getInstance()->getResponse()->addStylesheet('/sfNiceformsPlugin/css/default/niceforms');
  }
}
?>