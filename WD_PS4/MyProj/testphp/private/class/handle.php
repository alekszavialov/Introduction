<?php
    class HandleData{

        private $input_data;

        function __construct($input_data)
        {
            $this->input_data = $input_data;
        }

        public function divData(){
            return $this->input_data / 2;
        }

    }
?>