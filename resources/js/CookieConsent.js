export default () => {
    const message =
        "We use cookies to enhance your web browsing experience. By continuing to browse the site you agree to our policy on cookie usage.";

    //check cookies
    if (document.cookie) {
        let cookieString = document.cookie;
        let cookieList = cookieString.split(";");
        // if cookie named OKCookie is found, return
        for (let x = 0; x < cookieList.length; x++) {
            if (cookieList[x].indexOf("its_coockie_consent") != -1) {
                return;
            }
        }
    }
    let cookieConsentDiv = document.createElement("div");
    cookieConsentDiv.id = "indietech-cookie-consent-bar";
    cookieConsentDiv.style.display = "block";
    cookieConsentDiv.style.padding = "20px 0px";
    cookieConsentDiv.style.boxShadow = "rgba(0, 0, 0, 0.17) 0px 0px 8px 0px";
    cookieConsentDiv.style.position = "fixed";
    cookieConsentDiv.style.width = "100%";
    cookieConsentDiv.style.left = "0";
    cookieConsentDiv.style.bottom = "0";
    cookieConsentDiv.style.background = "#fff";

    let container = document.createElement("div");
    container.style.justifyContent = "center";
    container.classList.add("flex");
    container.classList.add("flex-col");
    container.classList.add("md:flex-row");

    container.classList.add("container");
    container.classList.add("items-center");

    let policyLink = document.createElement("a");
    policyLink.href = "/privacy";
    policyLink.innerHTML = "Privacy Policy";
    policyLink.classList.add("btn");
    policyLink.classList.add("btn-secondary");
    policyLink.classList.add("text-center");
    policyLink.classList.add("btn-sm");
    policyLink.classList.add("text-right");
    policyLink.classList.add("h-[50px]");
    policyLink.classList.add("ml-0");
    policyLink.classList.add("md:ml-5");
    policyLink.classList.add("mt-3");
    policyLink.classList.add("w-full");
    policyLink.classList.add("md:w-auto");

    let okButton = document.createElement("button");
    // okButton.classList.add("indietech-dismiss-cookie-bar");
    okButton.id = "indietech-dismiss-cookie-bar";
    okButton.innerHTML = "OK";
    okButton.classList.add("btn");
    okButton.classList.add("btn-primary");
    okButton.classList.add("text-center");
    okButton.classList.add("btn-sm");
    okButton.classList.add("ml-0");
    okButton.classList.add("md:ml-5");
    okButton.classList.add("mt-3");
    okButton.classList.add("h-[50px]");
    okButton.classList.add("w-full");
    okButton.classList.add("md:w-auto");

    let pMessage = document.createElement("p");
    pMessage.innerHTML = message;

    container.append(pMessage);
    container.append(policyLink);
    container.append(okButton);

    cookieConsentDiv.append(container);

    document.body.append(cookieConsentDiv);

    function closeCookie() {
        var cookieExpire = new Date();
        cookieExpire.setFullYear(cookieExpire.getFullYear() + 2);
        document.cookie =
            "its_coockie_consent=1; expires=" + cookieExpire.toGMTString() + "; path=/";
        document.body.removeChild(cookieConsentDiv);
    }
    document
        .querySelector("#indietech-dismiss-cookie-bar")
        .addEventListener("click", () => closeCookie());
};
