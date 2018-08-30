<?php
    /**
     * Created by PhpStorm.
     * User: MSI
     * Date: 5/21/2018
     * Time: 4:10 AM
     */

    namespace App\Http\Lib;
    use Form;
    use Illuminate\Support\MessageBag;

    class FormBuilder
    {
        public function __construct($formInfo=array(),$model=null)
        {
            $method=$formInfo['method']??'POST';
            $class=$formInfo['class']??null;
            $files=$formInfo['files']??false;

            if (isset($model)){
                echo Form::model($model,['method'=>$method,'action' => [$formInfo['action'],$model->id],'class'=>$class,'files' => $files]);
            }else{
                echo Form::open(['method'=>$method,'action' => $formInfo['action'],'class'=>$class,'files' => $files]);
            }
        }
        public function createField($name,$inputField=array()){
            $type=$inputField['type'];
            $required=isset($inputField['required'])?'required':'';

            $value=$inputField['value']?? null;



            $labelPlaceholder=$inputField['label_place']??ucfirst($name);
            $inputPlaceholder=$inputField['input_place']??ucfirst($name);
            $labelClass=$inputField['label_class']??'';
            $inputClass=$inputField['input_class']??'form-control';

            $input="<div class='form-group'>";
            $lebel=Form::label("$name", $labelPlaceholder, ['class' => $labelClass,'for'=>$name]);
            $input.=$lebel;

            if ($type=='password'){
                $field=Form::$type($name,['placeholder'=>$inputPlaceholder,'class' => $inputClass,'id'=>$name,$required]);
            }elseif($type=='checkbox'){
                $field=Form::$type($name,$value,null,['class'=>$inputClass,'id'=>$name,$required]).$value;
            }elseif($type=='file'){
                $field=Form::$type($name,['class'=>$inputClass,'id'=>$name,$required]);

                if (isset($inputField['has_file'])){
                    $img=$inputField['has_file']??null;
                    if (!empty($img) && isset($img)){
                        $prefix=$inputField['prefix'];
                        echo "<img src=$prefix$img height='100' width='100'/>";
                    }
                }

            }elseif($type=='textarea'){
                $field=Form::$type($name,$value,['placeholder'=>$inputPlaceholder,'class' => $inputClass,'id'=>$name,$required,'rows'=>$inputField['rows']??5]);
            }elseif($type=='select'){
//                dd($value);
                $field=Form::$type($name,$value,$inputField['selected']??'publish',['class' => $inputClass,'id'=>$name,$required]);
            }else{
                $field=Form::$type($name,$value,['placeholder'=>$inputPlaceholder,'class' => $inputClass,'id'=>$name,$required]);
            }
            $input.=$field;

            $errorMsg=$inputField['msg']??null;

            if (isset($errorMsg)){
                $msg = "<span class='alert-danger'>";
                $msg.="<strong>$errorMsg</strong>";
                $msg.="</span>";
                $input.=$msg;
            }

            $input.="</div>";

            echo $input;


        }
        public static function rawInput($inputData){
            echo $inputData;
        }
        public function submit($submit=array()){

            echo Form::submit($submit['value']??'Add',['class'=>$submit['class']??null]);
            if (isset($submit['wrapper'])){
                echo $submit['wrapper'];
            }
            echo Form::close();
        }
    }