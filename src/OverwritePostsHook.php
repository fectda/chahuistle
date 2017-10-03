<?php
namespace Cltvo\Chahuistle;

use Cltvo\Chahuistle\Managers\HooksManager;
use Cltvo\Chahuistle\Helpers\StringHelper;

class OverwritePostsHook extends HooksManager
{

	const IS_FEMALE_LABEL = true;

	const PLURAL_LABEL = 'entradas';

	const SINGULAR_LABEL = 'entrada';

	const FEATURED_IMAGE_LABEL = 'imagen desatacada';

    protected $tag = "init";

    public function getCallback(array $callback_args){
		global $wp_post_types;

		$wp_post_types['post']->labels = $this->overwriteLabels();
		$wp_post_types['post']->label = static::sanitizeString(static::PLURAL_LABEL);


		foreach ($wp_post_types['post'] as $key => $value) {

			$overwrite_method = 'overwrite'.ucfirst( StringHelper::generateCamelCase($key));
			if ( method_exists($this, $overwrite_method) ) {
				$wp_post_types['post']->{$key} = $this->{$overwrite_method}();
			}
		}
    }

	protected function overwriteLabel()
	{
		$labels = $this->getLabels();
		array_walk($labels, function(&$value,$key){
			$value = ($key  == 'name_admin_bar') ? $value : static::sanitizeString($value) ;
		});

		return  (object) $labels;
	}

	protected function overwriteLabels()
	{
		return  (object) array_map(function($value){
			return static::sanitizeString($value) ;
		}, $this->getLabels());
	}



	protected static function sanitizeString($string)
	{
		return  is_string($string) ? ucfirst( strtolower($string) ) : $string;
	}



	protected function getLabels()
	{
		$ao = (static::IS_FEMALE_LABEL ? 'a' : 'o' );
		$new = 'nuev'.$ao;

		return [
			'name'                   => __(static::PLURAL_LABEL, transDomain()),
			'singular_name'          => __(static::SINGULAR_LABEL, transDomain()),
			'add_new'                => __('Añadir '.$new, transDomain()),
			'add_new_item'           => __('Añadir '.$new.' '.static::SINGULAR_LABEL, transDomain()),
			'edit_item'              => __('Editar '.static::SINGULAR_LABEL, transDomain()),

			'new_item'               => __($new.' '.static::SINGULAR_LABEL, transDomain()),
			'view_item'              => __('Ver '.static::SINGULAR_LABEL, transDomain()),
			'view_items'             => __('Ver '.static::PLURAL_LABEL, transDomain()),
			'search_items'           => __('Buscar '.static::PLURAL_LABEL, transDomain()),
			'not_found'              => __('No se encontraron '.static::PLURAL_LABEL.'.', transDomain()),

			'not_found_in_trash'     => __((static::IS_FEMALE_LABEL ? 'Ninguna' : 'Ningún' ).' '.static::SINGULAR_LABEL.' '.'encontrad'.$ao.' en la papelera.', transDomain()),
			'parent_item_colon'      => null,
			'all_items'              => __('Volver a '.'tod'.$ao.'s l'.$ao.'s'.' '.static::PLURAL_LABEL, transDomain()),
			'archives'               => __('Archivos de '.static::PLURAL_LABEL, transDomain()),
			'attributes'             => __('Atributos de '.static::SINGULAR_LABEL, transDomain()),

			'insert_into_item'       => __('Insertar en '.(static::IS_FEMALE_LABEL ? 'la' : 'el' ).' '.static::SINGULAR_LABEL, transDomain()),
			'uploaded_to_this_item'  => __('Subido a '.(static::IS_FEMALE_LABEL ? 'esta' : 'este' ).' '.static::SINGULAR_LABEL, transDomain()),
			'featured_image'         => __(static::FEATURED_IMAGE_LABEL, transDomain()),
			'set_featured_image'     => __('Añadir '.static::FEATURED_IMAGE_LABEL, transDomain()),
			'remove_featured_image'  => __('Eliminar '.static::FEATURED_IMAGE_LABEL, transDomain()),

			'use_featured_image'     => __('Usar como '.static::FEATURED_IMAGE_LABEL, transDomain()),
			'filter_items_list'      => __('Lista de '.static::PLURAL_LABEL.' '.'filtrad'.$ao.'s', transDomain()),
			'items_list_navigation'  => __('Navegación por el listado de '.static::PLURAL_LABEL, transDomain()),
			'items_list'             => __('Lista de '.static::PLURAL_LABEL, transDomain()),
			'menu_name'              => __(static::PLURAL_LABEL, transDomain()),

			'name_admin_bar'         => __(static::SINGULAR_LABEL, transDomain()),
		];
	}


}
