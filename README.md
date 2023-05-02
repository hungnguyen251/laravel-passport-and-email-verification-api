# LARAVEL V10 - RESTFUL API WITH PASSPORT AUTHENTICATION AND EMAIL VERIFICATION

### Included Packages

- [laravel/passport@^11.8](https://github.com/laravel/passport)

### Installation

- Install the `composer` dependencies.

    - `composer create-project`
    - `composer install`
    - `php artisan migrate`
    - `php artisan passport:install`

### Config database and email in .env file
- Configuration 
    ```php
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=tests
    DB_USERNAME=root
    DB_PASSWORD=

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=admin@gmail.com
    MAIL_PASSWORD=
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=
    MAIL_FROM_NAME=
    ```

### Add register and login endpoint API

- Add endpoint in `routes/api.php`.

    ```php
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    ```

- Create AuthController.

    ```php
    <?php
        namespace App\Http\Controllers\Api\Auth;

        use App\Http\Controllers\Controller;
        use App\Models\User;
        use Illuminate\Auth\Events\Registered;
        use Illuminate\Http\Request;
        use Illuminate\Http\JsonResponse;
        use Illuminate\Support\Facades\Hash;
        use Illuminate\Support\Facades\Validator;
        use Symfony\Component\HttpFoundation\Response;
        use Mockery\Exception;
        use Illuminate\Support\Facades\Auth;

        class AuthController extends Controller 
        {
            /**
            * @param Request $request
            * @return JsonResponse
            */
            public function register(Request $request)
            {

            }

            /**
            * @param Request $request
            * @return JsonResponse
            */

            public function login(Request $request)
            {
                
            }

            /**
            * @return JsonResponse
            */
            public function logout() {
                
            }
        }
    ```

## RESPONSE API 

- Method for register (POST) `http://127.0.0.1:8000/api/auth/register`
    ```php
    {
        "message": "User Registered",
        "data": {
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNjMxZjU0M2ZiODM0NzdhOGMyNTVkZDRjNDI5ZWRlMDQ5MDJmZjFlNTJhYzM5YTE2ZmM1YWQ0OTliY2RmZTVhZmI0ZTU5YjUzZmU3ODlkZmQiLCJpYXQiOjE2ODMwMjg4NTcuNjM0MTc5LCJuYmYiOjE2ODMwMjg4NTcuNjM0MTg0LCJleHAiOjE3MTQ2NTEyNTcuNjE0NSwic3ViIjoiMyIsInNjb3BlcyI6W119.d6rEQbh2WVuSXCfXrHExJSY-amKD0DFkdk_4IsCOp3BXY30SE2EgsqMsltdWtbdqmEWbuAj5QrYB0cj27kDGEYlumUHIk4_RMV-_QmlkEg7PTQZ2uVTFTdm7CuEteEfA3a0YQGMwJhFkkSt3TKwWAxu2WsaTSW5IQyWOunm4oK8Cd2r2qN5xHaH7R_Un-fZhFKnNpqESfv5rr5WKMBShd2pCMeKnT05sSSl785O7vkryD3CE5SZVyEsdJT0SJPERG9ygSqMX5PafYmbw5cLVpdhx1-t9U8x1pNcC5SU7kGA2fpk--sI84fD5bRO5L06z8QscPcb2hMITLbc8CBoBBf8eJfaKJ1s4u90qd1HpIK21mTFTB3hGzeuzvaNLPO26Vke7eT0XT-3vjNJMtz32hTn6hBUBbbN5B6YZWkLuRLi_LGs7nRXMA3uAvcbpOxG0vzDAiQnVLtYgbO3wJ3qFJevcDnLo0aszSBYg25YA5K_AHepn577ig6uaRK5mjIOF6mKiD9h3BGYvIJDm5SsYT-fTrP9jCGlpZ18wXhbsauIAOAmIcTDJbzazcHQ07R1N_Henzb_7p64wsZJk7V1YjTkS6ULn2eM6mi4Prg0g983Y_nyib-kbHCZuNng_BI6BBTCeZqKqi7XiI1rWCgzvxnCzy_HOaMl3nliXOAWzISA",
            "user": {
                "name": "admin",
                "email": "admin@gmail.com",
                "updated_at": "2023-05-02T12:00:45.000000Z",
                "created_at": "2023-05-02T12:00:45.000000Z",
                "id": 1
            }
        }
    }
    ```
- Method for login (POST) `http://127.0.0.1:8000/api/auth/login`

    ```php
    {
        "message": "Logged in successfully",
        "data": {
            "user": {
                "id": 1,
                "name": "admin",
                "email": "admin@gmail.com",
                "email_verified_at": null,
                "created_at": "2023-05-02T11:41:40.000000Z",
                "updated_at": "2023-05-02T11:41:40.000000Z"
            },
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYmVlYzVhZmE3MWNlZjhhOTJkM2EwMWY4OWFlN2NmYmIxNzc0NTRiODZiZDU1ZjkzMDFlYjlhYjA4ODQxZjg0MGY1NDdjMmE3ZjU0OTJkMmMiLCJpYXQiOjE2ODMwMjc4OTQuOTUzMTQ2LCJuYmYiOjE2ODMwMjc4OTQuOTUzMTU3LCJleHAiOjE3MTQ2NTAyOTQuOTM2MDM2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Twt466JYI0YQ3M0tsq1XHcypdyqgtzEUWuOzQ9XWYw6CqGOvOwjEYFHd7WlZ5J-YWi9WKq7SNcNZ0GJuGejmR2SA9k4ghiEuZtsGE1YZTqX8-QPkwmRD_QraciU3cOIEXq45QbGwOWlJP_Y1Nqk-9XStOpU0XRr4mks9zGjZI2b2Jk7qc3sWn0_nab0a4Doz-Rf2yepPAi51roge4h5JmBf2i3LqAPIrjFc8smVMwnMnyGvpxgDJFYCMbonK5YVlvS7UD_9huCFVNPZojctEptL2kjXuXNfJ_ppWyjrEtAH0SuhIpgb2IO8yF0zU3VkVFYax08NNws763A2EMLK7eu0nZKC93tWgSP6VLPG7aphcjLP4y9UTxacW7XurfG0DIBu4UE9nOA9cVrZWU0ohbUPo8Gmy4fhms5z52C3Hx9_TgeQJ00Ojg7jHm3_mXbaLzR3PQTDpS4yk8MfUL5rWAUYk1NZ3_QOO6sgvEEZ7x9_aQwk3xILy0y98h8Grs5skd-rWyBMaXcWqa0WtNPtgSz25sd8uX_0-rLMbsFmhBWL2a9qEtLqA-sTL3YE1D18LYKzqaxIkF7YSGj3JUuGSF8VpqyUaVuigvo2WtkqhPaoVahilaH3mPxhmmRRsspu8mW2gitlC5nzEK_T5juBLcfmvGKDxPFHwSnKEBnoOf94"
        }
    }
    ```
