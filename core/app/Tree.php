<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tree extends Model
{

    public static function getNestedTreeForD3($user_id, $max_deep = 1, $current_deep = 1){

        $tree = [];
        
        $childrens = User::where('referrer_id', $user_id)
        ->orderBy('id')
        ->get();

        foreach($childrens as $child){

            $children = false;

            if ($current_deep < $max_deep) {
                $tree_child = Tree::getNestedTreeForD3($child->id, $max_deep, $current_deep + 1);

                if ($tree_child) {
                    $children = $tree_child;
                }
            }

            $image = ($child->image == '') ? asset('assets/images/user_profile_pic/default.jpg') : asset('assets/images/user_profile_pic/'. $child->image);

            $tree_tmp = [
                'name' => $child->first_name . ' ' . $child->last_name,
                'imageUrl' => $image,
                'area' => 'Nivel: ' .  $current_deep,
                'profileUrl' => 'image',
                'office' => '',
                'tags' => '',
                'isLoggedUser' => $child->getMembershipStatus(),
                'unit' => [
                    'type' => '',
                    'value' => $child->membership->tittle ? $child->membership->tittle : 'Sin Plan'
                ],
                'positionName' => $child->username
            ];

            if ($children) {
               

                $afiliados = 0;
                foreach ($children as $c) {
                    $afiliados ++;
                    $afiliados += $c['afiliados'];
                }
                $tree_tmp['afiliados'] = $afiliados;
                $tree_tmp['area'] .= ' - Afiliados: ' . $afiliados;
                $tree_tmp['children'] = $children;

            }
            else{
                $tree_tmp['afiliados'] = 0;
            }

            $tree[] = $tree_tmp;

        }

        if ($current_deep == 1) {

            $root = User::find($user_id);

            $image = ($root->image == '') ? asset('assets/images/user_profile_pic/default.jpg') : asset('assets/images/user_profile_pic/'. $root->image);
            
            $tree_root = [
                'name' => 'Yo',
                'imageUrl' => $image,
                'area' => '',
                'profileUrl' => 'image',
                'office' => '',
                'tags' => '',
                'isLoggedUser' => true,
                'unit' => [
                    'type' => '',
                    'value' => $root->membership->tittle ? $root->membership->tittle : 'Sin Plan'
                ],
                'positionName' => $root->username,
            ];

            $afiliados = 0;
            foreach ($tree as $c) {
                $afiliados ++;
                $afiliados += $c['afiliados'];
            }
            $tree_root['afiliados'] = $afiliados;
            $tree_root['area'] .= 'Afiliados: ' . $afiliados;
            $tree_root['children'] = $tree;

            $tree = $tree_root;

        }

        
        if (count($tree) > 0) {
            
            return $tree;
        }
        else{
            return false;
        }
    }


    public static function getNestedTree($user_id, $max_deep = 1, $current_deep = 1){
        
        $children = User::where('referrer_id', $user_id)
        ->orderBy('id')
        ->get();

        $tree = [];

        foreach($children as $child){

            $tree[$child->id] = ['id' => $child->id, 'username' => $child->username];

            if ($current_deep < $max_deep) {
                $tree_child = Tree::getNestedTree($child->id, $max_deep, $current_deep + 1);

                if ($tree_child) {
                    $tree[$child->id]['children'] = $tree_child;
                    
                }
            } 
        }

        if (count($tree) > 0) {
            return $tree;
        }

        else{
            return false;
        }
    }

    public static function getNestedTreeStructure($user_id, $max_deep = 1, $current_deep = 1){
        
        $children = User::where('referrer_id', $user_id)
        ->orderBy('id')
        ->get();

        $tree = [];

        foreach($children as $child){

            $children = false;

            if ($current_deep < $max_deep) {
                $tree_child = Tree::getNestedTreeStructure($child->id, $max_deep, $current_deep + 1);

                if ($tree_child) {
                    $children = $tree_child;
                }
            }
            if($child->image == ''){
                $image = "/afiliado/assets/images/user_profile_pic/default.jpg";
            }
            else{
                $image ='/afiliado/assets/images/user_profile_pic/'. $child->image;
            }

            $tree_tmp = ['name' => $child->username, 'image' => $image, 'bio' => '<br>Nivel: ' .  $current_deep];

            if ($children) {
                $tree_tmp['children'] = $children;
            }

            $tree[] = $tree_tmp;

        
        }
        
        if (count($tree) > 0) {
            return $tree;
        }
        else{
            return false;
        }
    }
    

    public static function getNestedTreeForStructure($user_id, $max_deep = 1, $current_deep = 1){
        
        $tree = [];

        if ($current_deep == 1) {

            $root = User::find($user_id);
            $image = ($root->image == '') ? "/afiliado/assets/images/user_profile_pic/default.jpg" : '/afiliado/assets/images/user_profile_pic/'. $root->image;
            $tree[] = [
                'id' => $root->id,
                'name' => 'Yo soy solidario', 
                'img' => $image, 'nivel' => ''
            ];
        }

        $children = User::where('referrer_id', $user_id)
        ->orderBy('id')
        ->get();

        foreach($children as $child){

            $image = ($child->image == '') ? "/afiliado/assets/images/user_profile_pic/default.jpg" : '/afiliado/assets/images/user_profile_pic/'. $child->image;

            $tree_tmp = ['id' => $child->id, 'pid' => $child->referrer_id ,'name' => $child->username, 'img' => $image, 'nivel' => 'Nivel: ' .  $current_deep];

            $tree[] = $tree_tmp;

            if ($current_deep < $max_deep) {
                $tree_child = Tree::getNestedTreeForStructure($child->id, $max_deep, $current_deep + 1);

                if ($tree_child) {
                    foreach($tree_child as $child_){
                    
                        $tree[] = $child_;
                    }
                }
            }
        }
        
        if (count($tree) > 0) {
            return $tree;
        }
        else{
            return false;
        }
    }
    
}