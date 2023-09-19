//print_r($_POST);
        $userId = $this->input->post('id');
        //$id_daftar = 1; //tbl_kadar_yuran -> yuran pendaftaran
        //$jumlah_daftar = $this->kadar_model->get_amount($id_daftar);

        /// Set Time allow registration for 2023
        $endDate = strtotime(date('Y-m-d', strtotime('2022-12-31') ) );
        $currentDate = strtotime(date('Y-m-d'));

        //$pakej = $this->input->post('pakej');
        $pakej = $this->user_model->getRoleId($userId,"pakej","tbl_apply_users");
        if($pakej == "Keluarga") { 
            if($currentDate < $endDate) { // setting time new registration from today until 2023 only
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                $title_yuran = "Yuran Tahunan 2023";
                $jumlah_yuran = $this->kadar_model->get_amount_pakej(2023,"y_jumlah","tbl_kadar_yuran");
            } else { 
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                $title_yuran = "Yuran Tahunan ".date('Y');
                $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah","tbl_kadar_yuran");
            }
        } else if($pakej == "Bujang"){
            if($currentDate < $endDate) { // setting time new registration from today until 2023 only
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
                $title_yuran = "Yuran Tahunan 2023";
                $jumlah_yuran = $this->kadar_model->get_amount_pakej(2023,"y_jumlah_bujang","tbl_kadar_yuran");
            } else { 
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
                $title_yuran = "Yuran Tahunan ".date('Y');
                $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah_bujang","tbl_kadar_yuran");
            }
        }


        //penentuan yuran ahli biasa atau yuran ahli seumur hidup
        $roleType = $this->user_model->getRoleId($userId,"roleId","tbl_apply_users");