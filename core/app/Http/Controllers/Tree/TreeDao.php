<?php

namespace App\Http\Controllers\Tree;

use  App\Http\Controllers\Tree\UsersBinary;

class TreeDao {


    public function assignPosition($data) {
        $parentid = $data['parent'];
        // $existsParent = UsersBinary::findOrFail($parentid); // $this->list(array('_id' => $parentid));
        
        $existsParent = UsersBinary::where('id', $parentid)->get();
        
        $nataly = null;
        
        if (isset($existsParent) && count($existsParent) > 0) {
            $parent = $existsParent[0];
    
            // @bug
            if (is_null($parent['right'])  && $data['position'] == 'right') {
                // insert to nataly
    
                // que siempre posicione al usuario debajo del ultimo nodo del brazo derecho.
                $nataly = $this->insertNodeBase($data);
                // $update = UsersBinary::update($parent['id'], array('right' => $nataly['id']));
                // die($nataly->id);

                UsersBinary::where('id', $parent['id'])
                    ->update(['right' => $data['id']]); // $nataly['id']

                if ($nataly) {
                    return array('status' => true, 'data' => $nataly);
                }
            }
    
            if (is_null($parent['left']) && $data['position'] =='left') {
                // insert to nataly
    
                // que siempre posicione al usuario debajo del ultimo nodo del brazo derecho.
                $nataly = $this->insertNodeBase($data);
                //echo 'id:';
                //die(var_dump($nataly->id));
                $update =  UsersBinary::where('id', $parent['id'])
                ->update(['left' => $data['id']]); // $nataly->id

                if ($nataly) {
                    return array('status' => true, 'data' => $nataly);
                }
            }
        } else {
            echo 'no hay parent: ' . json_encode($existsParent);
        }
    
        return array('status' => false, 'data' => $nataly);
    }


    public function insertNodeBase($data) {
        
        $params = [
            'id' => $data['id'],
            'tag' => $data['tag'],
            'parent'=> $data['parent'],
            'left'=> null, 
            'right'=> null,
            'position' =>$data['position'],
            'value' => $data['value'],
            'directowner' => $data['directOwner']
        ];

        return UsersBinary::create($params);
    }
    
    
}