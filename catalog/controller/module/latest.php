<?php

class ControllerModuleLatest extends Controller {

	public function index($setting) {

		$this->load->language('module/latest');



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_tax'] = $this->language->get('text_tax');



		$data['button_cart'] = $this->language->get('button_cart');

		$data['button_wishlist'] = $this->language->get('button_wishlist');

		$data['button_compare'] = $this->language->get('button_compare');



		$this->load->model('catalog/product');



		$this->load->model('tool/image');



		$data['products'] = array();



		$filter_data = array(

			'sort'  => 'p.date_added',

			'order' => 'DESC',

			'start' => 0,

			'limit' => $setting['limit']

		);



		$results = $this->model_catalog_product->getProducts($filter_data);



		if ($results) {

			foreach ($results as $result) {

				if ($result['image']) {

					// $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);

					$image = $this->model_tool_image->resize($result['image'], 960, 960);

				} else {

					// $image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);

					$image = $this->model_tool_image->resize('placeholder.png', 960, 960);

				}



				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {

					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				} else {

					$price = false;

				}



				if ((float)$result['special']) {

					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				} else {

					$special = false;

				}



				if ($this->config->get('config_tax')) {

					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);

				} else {

					$tax = false;

				}



				if ($this->config->get('config_review_status')) {

					$rating = $result['rating'];

				} else {

					$rating = false;

				}



				$data['products'][] = array(

					'product_id'  => $result['product_id'],

					'thumb'       => $image,

					'text_flag'   => $result['text_flag'],

					'is_sale' 	  	   => $result['is_sale'],

					'price_percentage' => $result['price_percentage'],

					'name'        => $result['name'],

					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',

					'price'       => $price,

					'special'     => $special,

					'tax'         => $tax,

					'rating'      => $rating,

					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])

				);

			}



			return $this->load->view('module/latest', $data);

		}

	}

}

