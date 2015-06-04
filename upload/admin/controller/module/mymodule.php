<?php
/*
 * This module is designed to selectively export goods to marketplaces.
 */
class ControllerModuleMymodule extends Controller {
	private $error = array(); 
        
        /*
         * This function initializes the module.
         */
	public function index() {   
            
                /*
                 * loading the necessary libraries or models
                 */
		$this->language->load('module/mymodule');
                $this->load->model('setting/setting');
                $this->load->model('design/layout');
                /*
                 * initialization language
                 */
		$this->document->setTitle($this->language->get('heading_title'));
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
                /*
                 * checking errors
                 */
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                /*
                 * seting breadcrumbs
                 */
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
                /*
                 * generating urls
                 */
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
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/mymodule.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
        /*
         * validating module
        */
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
        /*
         * This function edit selected marketplaces.
         */
        public function edit()
        {
                /*
                 * loading the necessary libraries or models
                 */
                $this->language->load('module/mymodule');
                $this->load->model('catalog/category');
                $this->load->model('catalog/product');
                $this->load->model('design/layout');
		$this->document->setTitle($this->language->get('heading_title'));
                /*
                 * initialization language
                 */
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
                /*
                 * checking errors
                 */
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                /*
                 * seting breadcrumbs
                 */
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
                
                /*
                 * geting list of all categories
                 */
                $this->data['category_list'] = $this->model_catalog_category->getCategories();
                /*
                 * seting token for ajax
                 */
                $this->data['token'] = $this->session->data['token'];


		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'mymodule/edit.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
        }
        /*
         * This function get product's id, which are included in the selected categories.
         */
        public function getProductsForExport()
        {
            /*
             * POST data
             */
            $categorysIdString = $_POST['categors_id']; 
            $exportedProductToCatregor = $_POST['exported_products_id'];
            /*
             * set an associative array "categories to products" from POST data
             */
            $productsId = explode(",", $exportedProductToCatregor);
            foreach ($productsId as $oneProd)
            {
                $tmp = explode("-", $oneProd);
                for($i = 1; $i < count($tmp); $i++)
                {
                    $categorsToProd [$tmp[$i]][] = $tmp[0]; 
                }
                
            }
            $categorysId = explode(",", $categorysIdString);
 
            $prodToCategors = array();
            foreach ($categorysId as $oneCategorId)
            { 
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE  category_id = '" . $oneCategorId . "'");
		if ($query->num_rows) {
                    foreach ($query->rows as $oneRow)
                    {
                        if(isset($categorsToProd[$oneCategorId]))
                        {
                            if (!in_array($oneRow['product_id'], $categorsToProd[$oneCategorId]))
                                $prodToCategors[$oneRow['product_id']][] = $oneCategorId;
                        }
                        else
                        {
                            $prodToCategors[$oneRow['product_id']][] = $oneCategorId;
                        }
                    }
                }	
            }
            
            $html = $this->generateHtmlForProducts($prodToCategors);
            echo $html;            
        }
        
        public function updateProductsForExport()
        {
            $productsToCatregor = $_POST['products_id'];
            $exportedProductToCatregor = $_POST['exported_products_id'];
            $exportedProductsId = explode(",", $exportedProductToCatregor);
            $productsId = explode(",", $productsToCatregor);

            foreach ($exportedProductsId as $oneProd)
            {
                $tmp = explode("-", $oneProd);
                for($i = 1; $i < count($tmp); $i++)
                {
                    $prodToCategorsExported[$tmp[0]][] = $tmp[$i]; 
                }
                
            }
            foreach ($productsId as $oneProd)
            {
                $tmp = explode("-", $oneProd);
                for($i = 1; $i < count($tmp); $i++)
                {
                    if(isset($prodToCategorsExported[$tmp[0]]))
                    {
                        if(!in_array($tmp[$i],$prodToCategorsExported[$tmp[0]]))
                        {
                            $prodToCategors[$tmp[0]][] = $tmp[$i]; 
                        }
                    }
                    else
                    {
                        $prodToCategors[$tmp[0]][] = $tmp[$i];
                    }
                }
                
            }
            
            $html = $this->generateHtmlForProducts($prodToCategors);
           
            echo $html;            
        }
        
        public function generateHtmlForProducts($prodToCategors)
        {
            $this->load->model('catalog/product');
            $uniqueProductsId = array_keys($prodToCategors);
            $html = "<table>
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
                $categorsString = implode("-",$prodToCategors[$oneUniqueProductId]);
                $i ++;
                $products = $this->model_catalog_product->getProduct((int)$oneUniqueProductId);
                $html.= "<tr id='tr_product_".$i ."'><td><input class='product-check' type='checkbox' id='product_".$i ."' value=".$products['product_id']."-".$categorsString."></td><td><img src='http://localhost/opencart/upload/image/".$products['image']."' width='100' height='100'></td><td>".$products['name']."</td></tr>";
                
            }
            
            $html.= "</tbody></table>";
            return $html;
        }
        
        public function getExport()
        {
            $this->load->model('catalog/product');
            $this->load->model('catalog/category');
            $productsIdString = $_POST['categors_id'];
            $categorsToProd = array();
            $productsId = explode(",", $productsIdString);

            foreach ($productsId as $oneProd)
            {
                $tmp = explode("-", $oneProd);
                for($i = 1; $i < count($tmp); $i++)
                {
                    $categorsToProd [$tmp[$i]][] = $tmp[0]; 
                }
                
            }
            $uniqueCategorsId = array_keys($categorsToProd);
            $html = "<table><tbody>";
            $i = -1;
            foreach ($uniqueCategorsId as $oneUniqueId)
            {
                
                $categors_info = $this->model_catalog_category->getCategory($oneUniqueId);
                $html.= "<tr ><td></td><td colspan='2'>Категория: ".$categors_info['name']."<td>";
                foreach ($categorsToProd[$oneUniqueId] as $oneProductId)
                {   
                    $i ++;
                    $products = $this->model_catalog_product->getProduct($oneProductId);
                    $html.= "<tr id='tr_export_".$i ."'><td><input class='export-check' type='checkbox' id='export_".$i ."' value=".$products['product_id']."-".$oneUniqueId."></td><td><img src='http://localhost/opencart/upload/image/".$products['image']."' width='100' height='100'></td><td>".$products['name']."</td></tr>";
                }
                     
            }
            $html.= "</tbody></table>";
            echo $html;       
        }
}
?>