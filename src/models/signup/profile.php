<?php
namespace app\models\signup;

use app\Model;
use app\models\helpers\Validate;

class Profile extends Model
{
    use Validate;

    public function validate()
    {
        if ($this->tokenExists("signup_profile_tkn", INPUT_POST)) {
            $this->session->array(INPUT_POST);
            header("Location: http://localhost/signup/profile", true, 303);
            exit;
        }

        if (
            $this->tokenExists("signup_profile_tkn", $_SESSION)
            && $this->tokenIsValid("random_tkn", "signup_profile_tkn", $_SESSION)
        ) {
            $this->retrieveSession();
            $this->session->unset();

            if (!$this->isEmpty() && !$this->patternMismatch()) {
                $this->saveToSession();
                header("Location: http://localhost/signup/role", true, 303);
                exit;
            }
        }

        $this->retrieveSession();
        $this->random_tkn = $this->generateToken();
        $this->session->random_tkn = $this->random_tkn;
        $this->main();
    }

    private function saveToSession()
    {
        $this->session->signup_profile_tkn = $this->signup_profile_tkn;
        $this->session->signup_fst_name = $this->signup_fst_name;
        $this->session->signup_lst_name = $this->signup_lst_name;
        $this->session->signup_email = $this->signup_email;
    }

    private function isEmpty()
    {
        $this->invalid_fst_name = "false";
        $this->invalid_lst_name = "false";
        $this->invalid_email = "false";

        if (!$this->signup_fst_name) {
            $this->invalid_fst_name = "true";
            $this->err_fst_name = "Please enter your first name.";
        } 

        if (!$this->signup_lst_name) {
            $this->invalid_lst_name = "true";
            $this->err_lst_name = "Please enter your last name.";
        } 

        if (!$this->signup_email) {
            $this->invalid_email = "true";
            $this->err_email = "Please enter your email.";
        } 

        return preg_match("/true/", $this->invalid_fst_name . $this->invalid_lst_name . $this->invalid_email_name);
    }

    private function patternMismatch()
    {
        if (filter_var($this->signup_email, FILTER_VALIDATE_EMAIL)) {
            $this->invalid_email = "true";
            $this->err_email = "Your email format is not valid.";
            return true;
        }

        $this->invalid_email = "false";
        return false;
    }

    private function main()
    {
        $this->main_tags = <<<html
        <h1 class="hdng">Who are you?</h1>
        <form class="form" action="/signup/profile" method="POST">
            <fieldset class="entries">
                <label class="entry">
                    <span class="entry-lbl"> First Name </span>
                    <input class="entry-input" type="text" aria-invalid="{$this->invalid_fst_name}" aria-errormessage="err_fst_name" name="signup_fst_name" value="{$this->signup_fst_name}">
                    <span class="entry-err" id="err_fst_name">{$this->err_fst_name}</span> 
                </label>
                <label class="entry">
                    <span class="entry-lbl"> Last Name </span>
                    <input class="entry-input" type="text" aria-invalid="{$this->invalid_lst_name}" aria-errormessage="err_lst_name" name="signup_lst_name" value="{$this->signup_lst_name}">
                    <span class="entry-err" id="err_lst_name">{$this->err_lst_name}</span> 
                </label>
                <label class="entry entry--email">
                    <span class="entry-lbl"> Email </span>
                    <input class="entry-input" type="email" aria-invalid="{$this->invalid_email}" aria-errormessage="err_email" name="signup_email" value="{$this->signup_email}">
                    <span class="entry-err" id="err_email">{$this->err_email}</span> 
                </label>
                <input type="hidden" name="signup_profile_tkn" value="{$this->random_tkn}">
            </fieldset>
            <fieldset class="btns">
                <button class="btns-submit" type="submit">Next</button>
            </fieldset>            
        </form>
        html;
    }
}
?>