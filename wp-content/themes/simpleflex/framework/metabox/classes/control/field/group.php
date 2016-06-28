<?php

class VP_Control_Field_Group extends VP_Control_Field
{

	public function __construct()
	{
		parent::__construct();
	}

	public static function withArray($arr = array(), $class_name = null)
	{
		if(is_null($class_name))
			$instance = new self();
		else
			$instance = new $class_name;
		$instance->_basic_make($arr);
		return $instance;
	}

	public function render($is_compact = false)
	{
		$this->_setup_data();
		$this->add_data('is_compact', $is_compact);
		return VP_View::instance()->load('control/textarea', $this->get_data());
	}

	public function set_value($_value)
	{
		$this->_value = $_value;
		return $this;
	}

}

/**
 * EOF
 */

	/*function _enfactor_group($field, $mb, $repeating)
	{
		$ignore       = array('type', 'length', 'fields');
		$groups       = array();
		$indexed_name = '';
		$level        = null;
		if($repeating)
		{
			while($mb->have_fields_and_multi($field['name']))
			{
				if ($indexed_name === '') $indexed_name = $mb->get_the_loop_group_id();
				if (is_null($level)) $level = $mb->get_the_loop_level();
				$fields = array();
				foreach ($field['fields'] as $f)
				{
					if($f['type'] === 'group')
	 					$fields[$f['name']] = $this->_enfactor_group($f, $mb, $f['repeating']);
					else
	 					$fields[$f['name']] = $this->_enfactor_field($f, $mb, true);
				}
				$groups[] = array(
					'name'   => $mb->get_the_loop_group_name(true),
					'childs' => $fields
				);
			}
		}
		else
		{
			$length = isset($field['length']) ? $field['length'] : 1;
			while($mb->have_fields($field['name'], $length))
			{
				if ($indexed_name === '') $indexed_name = $mb->get_the_loop_group_id();
				if (is_null($level)) $level = $mb->get_the_loop_level();
				$fields = array();
				foreach ($field['fields'] as $f)
				{
					if($f['type'] === 'group')
	 					$fields[$f['name']] = $this->_enfactor_group($f, $mb, $f['repeating']);
					else
	 					$fields[$f['name']] = $this->_enfactor_field($f, $mb, true);
				}
				$groups[] = array(
					'name'   => $mb->get_the_loop_group_name(true),
					'childs' => $fields
				);
			}
		}
		// assign groups
		$group['groups']       = $groups;
		$group['indexed_name'] = $indexed_name;
		$group['level']        = $level;

		// assign other information
		$keys = array_keys($field);
		foreach ($keys as $key)
		{
			if(!in_array($key, $ignore))
			{
				$group[$key] = $field[$key];
			}
		}

		// sortable
		if(isset($group['sortable']) and $group['sortable'])
			$group['container_extra_classes'][] = 'vp-sortable';

		return $group;
	}*/