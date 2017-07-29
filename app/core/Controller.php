<?php

# @author Ravi Sharma <me@rvish.com>

# Copyright (c) 2017 Ravi Sharma (http://www.rvish.com)

# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.

class Controller
{
	protected $model;

	private $layout, $view, $data = [];

	public function __construct()
	{
		$this->model  = new stdClass();

		$this->layout('mylayout');
	}

	/**
	 * View Method to set view
	 *
	 * @param       $view
	 * @param array $data
	 */
	protected function view($view, $data = [])
	{
		$this->view = $view;
		$this->data = $data;

		require_once '../app/views/Layout/' . $this->layout . '.php';
	}

	/**
	 * Layout Method to set layout
	 *
	 * @param $layout
	 *
	 * @throws Exception
	 */
	protected function layout($layout)
	{
		if (file_exists('../app/views/Layout/' . $layout . '.php')) {
			$this->layout = $layout;
		} else {
			throw new Exception("Layout " . $layout . " doesn't exist, please create one in views/Layout");
		}
	}

    /**
     * Content Method to get content
     *
     * @throws Exception
     */
	private function content()
	{
		if (file_exists('../app/views/' . get_class($this) . '/' . $this->view . '.php'))
        {
			require_once '../app/views/' . get_class($this) . '/' . $this->view . '.php';
		} else {
			throw new Exception($this->view . " view does not exist, please create file " . get_class($this) . "/" . $this->view . ".php in views folder.");
		}
	}

    /**
     * Element Method to get elements inside views
     *
     * @param $element
     * @throws Exception
     */
	private function element($element)
	{
		if (file_exists('../app/views/Element/' . $element . '.php'))
        {
			require_once '../app/views/Element/' . $element . '.php';
		} else {
            throw new Exception($element . " element does not exist, please create file views/Element/" . $element . ".php ");
		}
	}
}