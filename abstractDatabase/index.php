<?php
    
    include "config.php";

    if(!class_exists("DB"))
    {
        class DB
        {


            public function connect()
            {
                return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            }




            public function getAll($table)
            {
                $db = $this->connect();
                $result = $db->query("SELECT * FROM {$table}");

                while ($row = $result->fetch_object()) 
                {
                    $results[] = $row; 
                }
                return $results;
            }




            public function insert($table,$data,$format)
            {
                if(empty($table) || empty($data))
                {
                    return false;
                }
                $db = $this->connect();

                $data = (array) $data;
                $format = (array) $format;
                $format = implode("",$format);
                $format = str_replace("%", "",$format);

                list($fields,$placeholders,$values) = $this->prep_query($data);
                
                array_unshift($values,$format);

                $stmt = $db->prepare("INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})");
                
                call_user_func_array(array($stmt, 'bind_param'), $this->ref_values($values));
               
                //$stmt->execute();

                if($stmt->affected_rows)
                {
                    return true;
                }
                return false;
            }



            public function getOne($table,$id)
            {
                $db = $this->connect();
                $result = $db->query("SELECT * FROM {$table} WHERE ID = $id");

                while ($row = $result->fetch_object()) 
                {
                    $results = $row; 
                }
                return $results;
                
            }



            public function get_row($query)
            {
                $results = $this->getAll($query);
                return $results[1];
            }



            public function delete($table,$id)
            {
                $db = $this->connect();
                $stmt = $db->prepare("DELETE FROM {$table} WHERE ID = ?");
                $stmt->bind_param('d',$id);
               // $stmt->execute();
            }



            public function update($table,$data,$format,$id)
            {
                if(empty($table) || empty($data))
                {
                    return false;
                }
                $db = $this->connect();//connect to the database
                $data = (array) $data;
                $format = (array) $format;

                $format = implode('',$format);
                $format = str_replace('%', '', $format);
                // $where_format = implode('',$where_format);
                // $where_format = str_replace('%', '', $where_format);
                // $format .= $where_format;

                list($fields,$placeholders,$values) = $this->prep_query($data,'update');

                $where_clause = "ID = $id";
                //$where_values = '';
                // $count = 0;

                // foreach ($where as $field => $value) {
                //     if($count > 0){
                //         $where_clause .= 'AND';
                //     }
                //     $where_clause .= $field . '=?';
                //     $where_values[] = $value;

                //     $count++;
                // }
                //Prepend $format into $values
                array_unshift($values,$format);
                //$values = array_merge($values,$where_values);
                //Prepary our query for binding
                $stmt = $db->prepare("UPDATE {$table} SET {$placeholders} WHERE {$where_clause}");
                //Dynamically bind value
                call_user_func_array(array($stmt,'bind_param'),$this->ref_values($values));
                //Execute query
                $stmt->execute();
                //check for successfull update
                if($stmt->affected_rows)
                {
                    return true;
                }
                return false;
            }




            private function prep_query($data,$type='insert')
            {
                $fields = '';
                $placeholders = '';
                $values = array();
                
                foreach ($data as $field => $value) 
                {
                   $fields .= "{$field},";
                   $values[] = $value;
                   
                   if($type == "update")
                   {
                        $placeholders .= $field . '=?,';
                   }else{
                       $placeholders .= '?,';
                   }
                }

                $fields = substr($fields, 0 , -1);
                $placeholders = substr($placeholders, 0 , -1);
                
                return array($fields, $placeholders, $values);
            }





            private function ref_values($array)
            {
                $refs = array();
                foreach($array as $key => $value)
                {
                    $refs[$key] = &$array[$key];
                }
                return $refs;
            }
        }

        $db = new DB;
        // print_r($db->insert('object',
        //     array(
        //         'post_title' => 'abstraction test',
        //         'post_content' => 'abstraction post content'),
        //         array('%s', '%s')));

            // print_r($db->update('object',
            //     array(
            //         'post_title' => 'abstraction test Update',
            //         'post_content' => 'abstraction test update content'),
            //     array('%s', '%s'),2));
            
        //print_r($db->delete('object',1));

        //print_r($db->getOne('object',3));

        //print_r($db->getAll('object'));
    }

?>