
import checkEmail from "../../resources/js/utils/checkEmail";

describe("checkEmail function", () => {
    test("Valid email addresses", () => {
        expect(checkEmail("test@example.com")).toBe(true);
        expect(checkEmail("user.name@domain.co.uk")).toBe(true);
        expect(checkEmail("name+alias@sub.domain.com")).toBe(true);
    });

    test("Invalid email addresses", () => {
        expect(checkEmail("plainaddress")).toBe(false);
        expect(checkEmail("missing@domain")).toBe(false);
        expect(checkEmail("missing.com")).toBe(false);
        expect(checkEmail("@missinguser.com")).toBe(false);
    });
});