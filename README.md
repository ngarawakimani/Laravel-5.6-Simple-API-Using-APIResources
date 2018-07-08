# Laravel 5.6 API Resources Example

This is a very basic example of how to build an api using laravel resources

## Getting Started

Clone the project by running

```
git clone https://github.com/ngarawakimani/Laravel-5.6-Simple-API-Using-APIResources.git
```
### Prerequisites

create a mysql database 

run the following commands

```
cp .env.example .env
php artisan key:generate

```

set the name of your database in your env file

then run the following commands

```
composer install
php artisan migrate

```

then start the development server by running

```
php artisan serve

```

## Routes file  

```php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//get all employees
Route::get('/employees', 'EmployeeController@index');

//get one employee
Route::get('/employee/{id}', 'EmployeeController@show');

//create one employee
Route::post('/employee', 'EmployeeController@store');

//update an employee
Route::put('/employee', 'EmployeeController@store');

//delete an employee
Route::delete('/employee/{id}', 'EmployeeController@destroy');

```

## Controller file 

``` php

namespace App\Http\Controllers;


use App\Employee;
use App\Http\Resources\EmployeeResource as EmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $employee = $request->isMethod('put') ? Employee::findOrfail($request->id) : new Employee;

        $employee->id = $request->input('id');
        $employee->fullname = $request->input('fullname');
        $employee->nationality = $request->input('nationality');
        $employee->occupation = $request->input('occupation');

        if ($employee->save()) {
            return new EmployeeResource($employee);
        } else {
            //handle fail
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return new EmployeeResource(Employee::findOrfail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Employee::findOrfail($id);

        if ($employee->delete) {
            return new EmployeeResource($employee);
        } else {
            //handle fail
        }
        
    }
}


```

## Resource file 

``` php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->id,
            'fullname'=>$this->fullname,
            'nationality'=>$this->nationality,
            'occupation'=>$this->occupation,
        ];
    }
}

```
## Author

* **Dancan Kimani** - *Initial work* - [Github](https://github.com/ngarawakimani) - [Website](https://ngara.co.ke)

## License

There is NO Lincense for this code use it as you please