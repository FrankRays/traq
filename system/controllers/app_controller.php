<?php
/**
 * Traq
 * Copyright (C) 2009-2011 Jack Polgar
 * 
 * This file is part of Traq.
 * 
 * Traq is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 only.
 * 
 * Traq is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Traq. If not, see <http://www.gnu.org/licenses/>.
 */

require_once APPPATH.'version.php';
require_once APPPATH.'common.php';

class AppController extends Controller
{
	public function __construct()
	{
		global $lang;
		parent::__construct();
		
		require_once APPPATH.'locale/'.settings('locale');
		
		View::$inherit_from = APPPATH.'defaults/views';
		
	}
}