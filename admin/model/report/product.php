<?php
class ModelReportProduct extends Model {
	public function getProductsViewed($data = array()) {
		$sql = "SELECT p.product_id, pd.name, p.model, p.viewed,p.image FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.viewed > 0 AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%' AND p.price LIKE '%" . $this->db->escape($data['filter_price']) . "%' AND p.model LIKE '%" . $this->db->escape($data['filter_model']) . "%' ORDER BY p.viewed DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalProductViews($data = array()) {
		$sql = "SELECT SUM(p.viewed) AS total FROM " . DB_PREFIX . "product as p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%' AND p.price LIKE '%" . $this->db->escape($data['filter_price']) . "%' AND p.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";

		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
	public function getStatusViewByDate($date,$product_id,$flag) {
		if($flag==1){
		  $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_viewed WHERE DATE(date_added) = CURDATE() AND product_id='" . (int)$product_id . "'";
		}else if($flag==2){
		  $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_viewed WHERE DATE(date_added) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY)) AND product_id='" . (int)$product_id . "'";
		}else{
		  $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_viewed WHERE product_id='" . (int)$product_id . "'";
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function getTotalProductsViewed($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product as p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%' AND p.price LIKE '%" . $this->db->escape($data['filter_price']) . "%' AND p.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";

		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function reset() {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = '0'");
	}

	public function getPurchased($data = array()) {
		$sql = "SELECT op.name, op.model, SUM(op.quantity) AS quantity, SUM(op.price + (op.tax * op.quantity)) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id)";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " WHERE o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " WHERE o.order_status_id > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		$sql .= " GROUP BY op.product_id ORDER BY total DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalPurchased($data) {
		$sql = "SELECT COUNT(DISTINCT op.product_id) AS total FROM `" . DB_PREFIX . "order_product` op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id)";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " WHERE o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " WHERE o.order_status_id > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}
