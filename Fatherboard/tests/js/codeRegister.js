
let default_regex = ".+@.+"


function checkEmail(test_email,def_regex=default_regex)
{
    reg = new RegExp(def_regex);
    return reg.test(test_email);
}

if (typeof module !== "undefined" && module.exports) {
    module.exports = { checkEmail };
}