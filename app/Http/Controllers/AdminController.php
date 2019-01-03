<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Employee;
use DB;
use App\Quotation;
use App\Role;
use App\Departament;
//use Nestable\NestableTrait;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
//use Kalnoy\Nestedset\NestedSet;


class AdminController extends Controller
{
    public function showHomePage()
     {
       if(session('username')!=null)
       {
          
          if (session('role')== 'admin') { // eshte admin
            // show the form
            //$userinfo = DB::table('employees')->where('username',session('username'))->first();
            //print_r($userinfo);
            //return view('home');
            //return view('dashboard');
            $departaments=Departament::all();
            $tree=$this->treeView();
           
            // return $tree;
            // $isemployee=0;
            // if($this->IsEmployee())
            // {
            //     $isemployee=1;
                
            // }
            // return $_GET['user'];
            //$query=
            //$employees=Employee::paginate(10);
            if(isset($_GET['user']) && $_GET['user']!=null)
            {
                $employees=DB::table('employees')
                        ->join('departaments', 'employees.DepartamentId', '=', 'departaments.DepartamentId')
                        ->where('employees.name','like', '%' .$_GET['user'].'%')
                        ->paginate(10);
                
                $search = $_GET['user'];
            }
            else
            {
                $employees=DB::table('employees')
                            ->join('departaments', 'employees.DepartamentId', '=', 'departaments.DepartamentId')
                            ->paginate(10);
                
                $search ='';
            }
           
            
            return View('dashboard')->with('data', $this->GetAdminInfo())->with('tree', $tree)->with('search', $search)->with('employees', $employees)->with('departaments',$departaments)->with('roles',Role::all())->with('dashboard', \Auth::user());
          }
          return \Redirect::to('home');
      }
        return \Redirect::to('login');
     }


    // public function createTree(&$list, $parent){
    //     $tree = array();
    //     foreach ($parent as $k=>$l){
    //         if(isset($list[$l['id']])){
    //             $l['children'] = createTree($list, $list[$l['id']]);
    //         }
    //         $tree[] = $l;
    //     } 
    //     return $tree;
    // }

    // public function buildTree($items) {
    //     $childs = array();
    //     foreach($items as $item)
    //         $childs[$item->DepartamentId][] = $item;
    //     foreach($items as $item) 
    //     if (isset($childs[$item->id]))
    //         $item->childs = $childs[$item->id];
    //     return $childs[1];
    // }

    // public function buildTree($items) {
    //     $childs = array();
    //     foreach($items as $item)
    //         $childs[$item->parent_id][] = $item;
    //     foreach($items as $item)
    //     if (isset($childs[$item->DepartamentId]))
    //         $item->childs = $childs[$item->DepartamentId];
    //     return $childs[0];
    // }

     public function update(Request $request)
     {
       
            $empl=Employee::all()->where('username','=',$request->prevusername)->first();
            //$empl=Employee::find($request->prevusername);
            $userinfo=User::find($request->prevusername);

            $pass=$request->password;

             $prevoptions=array(
                'username'=>$userinfo->username,
                'password'=>$userinfo->password,
                'role'=>$userinfo->role
            );
             
            if($request->roli==1) //pra nga punonjes eshte bere admin
            {
                
                try
                {
                    $validator = \Validator::make($request->all(), [
                        'username' => 'required|max:50',
                    ]);
            
                    if ($validator->fails()) {
                        return redirect('dashboard')
                                    ->withErrors($validator)
                                    ->withInput();
                    }

                    $user=$userinfo;
                    $user->username=$request->username;
                    
                    $user->role=$request->roli;

                   
                    if($pass!='') //nuk eshte ndryshuar passwordi
                     {
                        $user->password=$pass;
                     }

                    $user->save();
                    // DB::table('users')
                    //     ->where('username', $request->prevusername)
                    //     ->update([$options]);
                    
                    DB::table('employees')->where('username', '=', $request->prevusername)->delete();

                    \Redirect::back()->withErrors(['User modified successfully']);
                            
                    return \Redirect::to('dashboard');
                }
                catch(\Illuminate\Database\QueryException $ex){
                    $empl->save();//ruaj serish obj dhe kthe si ishte user

                   
                    DB::table('users')
                        ->where('username', $request->username)
                        ->update(['username'=>$userinfo->username,'password'=>$userinfo->password,'role'=>$userinfo->role]);

                    \Redirect::back()->withErrors(['User modifying failed']);
                            
                    return \Redirect::to('dashboard');
                }

            }
           
           else //nuk eshte ndryshuar roli
           {
               try
                {
                     //validating data
                    $validator = \Validator::make($request->all(), [
                        'username' => 'required|max:50',
                        'ssn' => 'required|max:50|min:3',
                        'name' => 'required|max:50|min:3',
                        'surname' => 'required|max:50|min:3',
                        'address' => 'required|max:100|min:3',
                    ]);

                    if ($validator->fails()) {
                        return redirect('dashboard')
                                    ->withErrors($validator)
                                    ->withInput();
                    }
       
                    $user=$userinfo;
                    $user->username=$request->username;
                    
                    $user->role=$request->roli;

                   
                    if($pass!='') //nuk eshte ndryshuar passwordi
                     {
                        $user->password=$pass;
                     }

                    $user->save();
                    
                    $employee=$empl;
                     $employee->ssn=$request->ssn;
                     $employee->name=$request->name;
                     $employee->surname=$request->surname;
                     $employee->address=$request->address;
                     $employee->username=$request->username;
                     $employee->departamentid=$request->departament;
                     $employee->save();
                    //print_r($userinfo);
                    //return $user->password;
                     \Redirect::back()->withErrors(['User modified successfully']);
                            
                     return \Redirect::to('dashboard');
                }
                 catch(\Illuminate\Database\QueryException $ex){
                      DB::table('employees')->where('username', '=', $request->username)->delete();

                      DB::table('users')
                      ->where('username', $request->username)
                      ->update(['username'=>$userinfo->username,'password'=>$userinfo->password,'role'=>$userinfo->role]);

                      \Redirect::back()->withErrors(['User modifying failed']);
                            
                     return \Redirect::to('dashboard');
                 }
           }
     }

    public function delete(Request $request)
    {
        
    //    $employee=Employee::find($request->deluser);
    //    $user=User::find($request->deluser);
        Employee::where('username','=',$request->deluser)->delete();
        User::where('username','=',$request->deluser)->delete();
       //if ($employee && $user) 
       //{
             //$employee->delete();
             //$user->delete();
       //}   
    //   
       return redirect('/dashboard');
    }

    public function GetAdminInfo()
    {
        
        If($this->IsEmployee()) //pra nqs admini eshte edhe punonjes 
        {
             $admininfo = DB::table('roles')
             ->join('users', 'roles.roleid', '=', 'users.role')
             ->join('employees', 'users.username', '=', 'employees.username')
             ->join('departaments', 'employees.departamentid', '=', 'departaments.departamentid')
             ->where('users.role', '=', 1)
             ->where('users.username', '=', session('username'))
             ->select('*')
             ->get();
        }
        else
        {
            //$admininfo=User::where('username', '=', 'test')->get();
            $admininfo = DB::table('users')
            ->where('username', '=', session('username'))
            ->select('*')
            ->get();
        }
        //return Departament::All();
        //print_r ($this->IsEmployee();
        $data = json_decode(json_encode($admininfo), true);
        
       // $employees= Employee::paginate(10);
       //$departaments=Departament::all();
       
       //$root= new Tree();
      // $tree = $root->buildTree($root->findDescendants()->get());
      
       //return ($employees);
       //foreach()
        return $data;
    }
    public function IsEmployee()
    {
          if(Employee::where('username', '=', session('username'))->exists()) {//zevendesohet me sessionin
            return true;
          }
        
          return false;
    }

    public function IsEmployeeToo($username)
    {
          if(Employee::where('username', '=', $username)->exists()) {//zevendesohet me sessionin
            return true;
          }
        
          return false;
    }


    public function store(Request $request)
    {
        
        
        //if($request->prevusername=='')//pra nqs eshte rregjistrim i ri
        //{
            $user=User::where('username', '=', $request->username)->first();
            if($user)
            {
                \Redirect::back()->withErrors(['Another User already exists with that username', 'Please try again']);
                return \Redirect::to('dashboard');
            }
            $employee=Employee::where('ssn', '=', $request->ssn)->first();
            if($employee)
            {
                \Redirect::back()->withErrors(['SSN must be unique for each employee']);
                return \Redirect::to('dashboard');
            }
           if($request->roli==1)//admin
           {
                    $validator = \Validator::make($request->all(), [
                        'username' => 'required|max:50',
                        'password' => 'required|min:3',
                    ]);

                    if ($validator->fails()) {
                        return redirect('dashboard')
                                    ->withErrors($validator)
                                    ->withInput();
                    }
                    try {
                        // DB::table('users')->insert(
                        //     ['username' => $request->username, 'password' => bcrypt($request->password),'role'=>$request->roli]
                        // );
                        $newuser= new User;
                        $newuser->username=$request->username;
                        $newuser->password=$request->password;
                        $newuser->role=$request->roli;
                        $newuser->save();
                        
                        \Redirect::back()->withErrors(['Admin Saved Successfully']);
                    
                        return \Redirect::to('dashboard');
                    }
                    catch(\Illuminate\Database\QueryException $ex){
                            DB::table('users')->where('username', '=', $request->username)->delete();
                            \Redirect::back()->withErrors(['Admin Registration Failed','Please try again']);
                            
                            return \Redirect::to('dashboard');
                        }
           }
           else //punonjes
           {
                $validator = \Validator::make($request->all(), [
                    'username' => 'required|max:50',
                    'password' => 'required|min:3',
                    'ssn' => 'required|max:50|min:3',
                    'name' => 'required|max:50|min:3',
                    'surname' => 'required|max:50|min:3',
                    'address' => 'required|max:100|min:3',
                ]);

                if ($validator->fails()) {
                    return redirect('dashboard')
                                ->withErrors($validator)
                                ->withInput();
                }
                try { 
                        // DB::table('users')->insert(
                        //     ['username' => $request->username, 'password' => bcrypt($request->password),'role'=>$request->roli]
                        // );
                        $newuser= new User;
                        $newuser->username=$request->username;
                        $newuser->password=$request->password;
                        $newuser->role=$request->roli;
                        $newuser->save();
                        
                        $employee = new Employee;
                        $employee->ssn=$request->ssn;
                        $employee->name=$request->name;
                        $employee->surname=$request->surname;
                        $employee->address=$request->address;
                        $employee->photo=null;
                        $employee->username=$request->username;
                        $employee->departamentid=$request->departament;
                        $employee->save();
                        
                        \Redirect::back()->withErrors(['Employee Saved Successfully']);
                    
                        return \Redirect::to('dashboard');
                        //print_r(Departament::all());
                    }
                catch(\Illuminate\Database\QueryException $ex){
                    DB::table('users')->where('username', '=', $request->username)->delete();
                    DB::table('employees')->where('username', '=', $request->username)->delete();
                    \Redirect::back()->withErrors(['Employee Registration Failed','Please try again']);
                    
                    return \Redirect::to('dashboard');
                }
                    
           }
    }


    public function treeView(){       
        $Departaments = Departament::where('parent_id', '=', 0)->get();
        $tree='<ul id="browser" class="filetree" style="background-color:#222D32;color:#FFFFFF"><li class="tree-view active">Departamentet</li>';
        foreach ($Departaments as $Departament) {
             $tree .='<li class="tree-view active" style="background-color:#222D32;color:#FFFFFF" <a class="tree-name" style="background-color:#222D32;color:#FFFFFF">'.$Departament->Name.'</a>';
             if(count($Departament->childs)) {
                //if(is_array($Departament->childs)) {
                $tree .=$this->childView($Departament);
            }
        }
        $tree .='<ul>';
        // return $tree;
        return $tree;
    }

    public function childView($Departament){                 
        $html ='<ul>';
        foreach ($Departament->childs as $arr) {
            if(count($arr->childs)){
            $html .='<li class="tree-view " style="background-color:#222D32;color:#FFFFFF"><a class="tree-name">'.$arr->Name.'</a>';                  
                    $html.= $this->childView($arr);
                }else{
                    $html .='<li class="tree-view " style="background-color:#222D32;color:#FFFFFF"><a class="tree-name">'.$arr->Name.'</a>';                                 
                    $html .="</li>";
                }
                               
        }
        
        $html .="</ul>";
        return $html;
} 

}
