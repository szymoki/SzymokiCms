<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:24:08
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of visitormodel
 *
 * @author https://roytuts.com
 */
class VisitorModel extends Model
{

    private $site_log = 'site_log'; //site log
    public $table     = 'site_log';
    public function __construct()
    {

    }

    public function get_site_data_for_today()
    {
        $results = [];
        $query   = $this->db->query('SELECT SUM(no_of_visits) as visits
            FROM ' . $this->site_log . '
            WHERE CURDATE()=DATE(access_date)
            LIMIT 1');
        if ($query->num_rows() == 1) {
            $row               = $query->row();
            $results['visits'] = $row->visits;
        }

        return $results;
    }

    public function get_site_data_for_last_week()
    {
        $results = [];
        $query   = $this->db->query('SELECT SUM(no_of_visits) as visits
            FROM ' . $this->site_log . '
            WHERE DATE(access_date) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+6 DAY
            AND DATE(access_date) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-1 DAY
            LIMIT 1');
        if ($query->num_rows() == 1) {
            $row               = $query->row();
            $results['visits'] = $row->visits;

            return $results;
        }
    }

    public function get_chart_data_for_today()
    {
        $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%h %p") AS hour
                FROM ' . $this->site_log . '
                WHERE CURDATE()=DATE(access_date)
                GROUP BY HOUR(access_date)');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return null;
    }

    public function get_chart_data_for_month_year($month = 0, $year = 0)
    {
        if ($month == 0 && $year == 0) {
            $month = date('m');
            $year  = date('Y');
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%d-%m-%Y") AS day
                FROM ' . $this->site_log . '
                WHERE MONTH(access_date)=' . $month . '
                AND YEAR(access_date)=' . $year . '
                GROUP BY DATE(access_date)');
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
        if ($month == 0 && $year > 0) {
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(timestamp,"%M") AS day
                FROM ' . $this->site_log . '
                WHERE YEAR(access_date)=' . $year . '
                GROUP BY MONTH(access_date)');
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
        if ($year == 0 && $month > 0) {
            $year  = date('Y');
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%d-%m-%Y") AS day
                FROM ' . $this->site_log . '
                WHERE MONTH(access_date)=' . $month . '
                AND YEAR(access_date)=' . $year . '
                GROUP BY DATE(access_date)');
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }

        if ($year > 0 && $month > 0) {
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%d-%m-%Y") AS day
                FROM ' . $this->site_log . '
                WHERE MONTH(access_date)=' . $month . '
                AND YEAR(access_date)=' . $year . '
                GROUP BY DATE(access_date)');
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }

        return null;
    }

}

/* End of file visitormodel.php */
/* Location: ./application/models/visitormodel.php */
