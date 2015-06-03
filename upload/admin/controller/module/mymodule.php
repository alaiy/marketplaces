<?php
class ControllerModuleMymodule extends Controller {
	private $error = array(); 

	public function index() {   
		$this->language->load('module/mymodule');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('mymodule', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');

		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/mymodule', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('module/mymodule', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['edit_prom'] = $this->url->link('module/mymodule/edit', 'token=' . $this->session->data['token'] . '&platform=Prom.ua', 'SSL');
                $this->data['edit_allbiz'] = $this->url->link('module/mymodule/edit', 'token=' . $this->session->data['token'] . '&platform=allbiz', 'SSL');
                $this->data['edit_zakupka'] = $this->url->link('module/mymodule/edit', 'token=' . $this->session->data['token'] . '&platform=zakupka', 'SSL');
		$this->data['modules'] = array();

		if (isset($this->request->post['mymodule_module'])) {
			$this->data['modules'] = $this->request->post['mymodule_module'];
		} elseif ($this->config->get('mymodule_module')) { 
			$this->data['modules'] = $this->config->get('mymodule_module');
		}	

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/mymodule.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
                
		$this->response->setOutput($this->render());
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/mymodule')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
        public function edit()
        {

                $this->language->load('module/mymodule');
                $this->load->model('catalog/category');
                $this->load->model('catalog/product');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('mymodule', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');

		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/mymodule', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
                $this->data['breadcrumbs'][] = array(
			'text'      => $_GET['platform'],
			'href'      => $this->url->link('module/mymodule/edit', 'token=' . $this->session->data['token'] . '&platform=' . $_GET['platform'], 'SSL'),
			'separator' => ' :: '
		);
	
		$this->data['modules'] = array();
                
		if (isset($this->request->post['mymodule_module'])) {
			$this->data['modules'] = $this->request->post['mymodule_module'];
		} elseif ($this->config->get('mymodule_module')) { 
			$this->data['modules'] = $this->config->get('mymodule_module');
		}	
                $this->data['category_list'] = $this->model_catalog_category->getCategories();
                $this->data['show_products'] = $this->url->link('module/mymodule/getProductsForExport', 'token=' . $this->session->data['token'], 'SSL');
                $this->data['token'] = $this->session->data['token'];
		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'mymodule/edit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
        }
        public function getProductsForExport()
        {
            $this->load->model('catalog/product');
            $categorysIdString = $_POST['categors_id'];
            $categorysId = explode(",", $categorysIdString);
            
            $html = "";
            $productsId = array();
            foreach ($categorysId as $oneCategorId)
            { 
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE  category_id = '" . $oneCategorId . "'");
		if ($query->num_rows) {
                    foreach ($query->rows as $oneRow)
                    {
                        $productsId [] = $oneRow['product_id'];
                    }
                }	
            }
            $uniqueProductsId = array_unique($productsId);
            $html.= "<table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>Фото</td>
                                <td>Название</td>
                            </tr>
                        </thead>
                    <tbody>";
            $i = -1;
            foreach ($uniqueProductsId as $oneUniqueProductId)
            {
                $i ++;
                $products = $this->model_catalog_product->getProduct((int)$oneUniqueProductId);
                $html.= "<tr><td><input class='product-check' type='checkbox' id='product_".$i ."' value=".$products['product_id']."></td><td><img src='http://localhost/opencart/upload/image/".$products['image']."' width='100' height='100'></td><td>".$products['name']."</td></tr>";
                
            }
            
            $html.= "</tbody></table>";
           
            echo $html;            
        }
        public function getExport()
        {
            
            $this->load->model('catalog/product');
            $productsIdString = $_POST['categors_id'];
            $productsId = explode(",", $productsIdString);
            
            $html = "";

            $uniqueProductsId = array_unique($productsId);
            $html.= "<table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>Фото</td>
                                <td>Название</td>
                            </tr>
                        </thead>
                    <tbody>";
            $i = -1;
            foreach ($uniqueProductsId as $oneUniqueProductId)
            {
                $i ++;
                $products = $this->model_catalog_product->getProduct((int)$oneUniqueProductId);
                $html.= "<tr><td><input class='export-check' type='checkbox' id='export_".$i ."' value=".$products['product_id']."></td><td><img src='http://localhost/opencart/upload/image/".$products['image']."' width='100' height='100'></td><td>".$products['name']."</td></tr>";
                
            }
            
            $html.= "</tbody></table>";

            echo $html;            
        }
}
?>