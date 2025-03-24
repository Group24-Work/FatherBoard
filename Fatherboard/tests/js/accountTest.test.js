

const path = require('path');

// const {checkEmail} = require(path.resolve(process.cwd(), 'public/js/register.js'));

const {checkEmail} = require("./codeRegister.js");


// JS test to check whether only valid emails are accepted through

describe("checkEmail function", () => {
    test.each([["soldierboy@gmail.com",true],
        ["santaclaus@gmail.com",true],
        ["dan@tdmgmail.com",true],
        ["lucas@protonmail.com",true],
        ["@gmail.com",false],
        ["dan@",false],
        ["luc.com",false]]
    )("valid email with regex", (em,val)=>
    {
        expect(checkEmail(em)).toBe(val);

    })
});