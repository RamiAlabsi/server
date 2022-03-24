const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerChat = get(".msger-chat");
msgerChat.scrollTop += 5000;

// const BOT_MSGS = [
//     "Hi, how are you?",
//     "Ohh... I can't understand what you trying to say. Sorry!",
//     "I like to play games... But I don't know how to play!",
//     "Sorry if my answers are not relevant. :))",
//     "I feel sleepy! :("
// ];

// Icons made by Freepik from www.flaticon.com
const BOT_IMG = "https://image.flaticon.com/icons/svg/327/327779.svg";
const PERSON_IMG = "https://image.flaticon.com/icons/svg/145/145867.svg";
const BOT_NAME = "BOT";
const PERSON_NAME = "Sajad";

msgerForm.addEventListener("submit", event => {
    event.preventDefault();

    const msgText = msgerInput.value;
    if (!msgText) return;

    appendMessage(PERSON_NAME, PERSON_IMG, "right", msgText);
    msgerInput.value = "";

    // botResponse();
});

function appendMessage(name, img, side, text) {
    //   Simple solution for small apps
    const msgHTML = `
        <div class="msg ${side}-msg">
        <div class="msg-img" style="background-image: url(${img})"></div>

        <div class="msg-bubble">
        <div class="msg-info">
        <div class="msg-info-name">${name}</div>
        <div class="msg-info-time">${formatDate(new Date())}</div>
        </div>

        <div class="msg-text">${text}</div>
        <div class="delete-icon" onclick="deleteMsg(this);"><i class="fas fa-times"></i></div>
        </div>
        </div>
    `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
    msgerChat.scrollTop += 500;
    saveMessage(text);
}

function appendImage(name, img, side, ImageSrc) {
    //   Simple solution for small apps
    const ImgHTML = `
        <div class="msg ${side}-msg">
        <div class="msg-img" style="background-image: url(${img})"></div>

        <div class="msg-bubble">
        <div class="msg-info">
        <div class="msg-info-name">${name}</div>
        <div class="msg-info-time">${formatDate(new Date())}</div>
        </div>

        <div class="msg-text"><img src="${ImageSrc}"/></div>
        <div class="delete-icon" onclick="deleteMsg(this);"><i class="fas fa-times"></i></div>
        </div>
        </div>
    `;

    msgerChat.insertAdjacentHTML("beforeend", ImgHTML);
    msgerChat.scrollTop += 500;
    console.log('append image');
}

function appendFile(name, img, side, srcFile) {
    //   Simple solution for small apps
    const FileHTML = `
        <div class="msg ${side}-msg">
            <div class="msg-img" style="background-image: url(${img})"></div>

            <div class="msg-bubble">
                <div class="msg-info">
                    <div class="msg-info-name">${name}</div>
                    <div class="msg-info-time">${formatDate(new Date())}</div>
                </div>

                <div class="msg-text">
                    <div class="uploaded-file">
                        <div class="icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                </path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    <div class="meta"><span></span>
            
                    </div>
                        <div class="action">
                            <a href="${srcFile}" download="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud">
                                    <polyline points="8 17 12 21 16 17"></polyline>
                                    <line x1="12" y1="12" x2="12" y2="21"></line>
                                    <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="delete-icon" onclick="deleteMsg(this);"><i class="fas fa-times"></i></div>
            </div>
        </div>
    `;

    msgerChat.insertAdjacentHTML("beforeend", FileHTML);
    msgerChat.scrollTop += 500;
    console.log('append file');
}

function botResponse() {
    const r = random(0, BOT_MSGS.length - 1);
    const msgText = BOT_MSGS[r];
    const delay = msgText.split(" ").length * 100;

    setTimeout(() => {
        appendMessage(BOT_NAME, BOT_IMG, "left", msgText);
    }, delay);
}

// Utils
function get(selector, root = document) {
    return root.querySelector(selector);
}

function formatDate(date) {
    const h = "0" + date.getHours();
    const m = "0" + date.getMinutes();

    return `${h.slice(-2)}:${m.slice(-2)}`;
}

function random(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}


function uploadImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            appendImage(PERSON_NAME, PERSON_IMG, "right", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
    console.log('upload image');
}

function saveMessage(txt = null, image = null, file = null) {
    var form = $('#myForm');
    peer_id = form.data('peer_id');
    _token = form.data('token');
    url = form.data('url');

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: _token,
            peer_id: peer_id,
            txt: txt,
            image: image,
            file: file
        },

        contentType: false,
        processData: false,
        success: function(data) {
            console.log("success");
            console.log(data);
            $('#chat_div').append(data);
        },
        error: function(data) {
            console.log("error");
            console.log(data);
        }
    });
}

function uploadFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            appendFile(PERSON_NAME, PERSON_IMG, "right", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
    console.log('upload file');
}

function appendOldMessage(name, img, side, text, date) {
    //   Simple solution for small apps
    const msgHTML = `
        <div class="msg ${side}-msg">
            <div class="msg-img" style="background-image: url(${img})"></div>

            <div class="msg-bubble">
                <div class="msg-info">
                    <div class="msg-info-name">${name}</div>
                    <div class="msg-info-time">${date}</div>
                </div>
                <div class="msg-text">${text}</div>
                <div class="delete-icon" onclick="deleteMsg(this);"><i class="fas fa-times"></i></div>
            </div>
        </div>
    `;

    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
    msgerChat.scrollTop += 500;
}

function appendOldImage(name, img, side, ImageSrc, date) {
    //   Simple solution for small apps
    const ImgHTML = `
        <div class="msg ${side}-msg">
            <div class="msg-img" style="background-image: url(${img})"></div>

            <div class="msg-bubble">
                <div class="msg-info">
                    <div class="msg-info-name">${name}</div>
                    <div class="msg-info-time">${date}</div>
                </div>
                <div class="msg-text"><img src="${ImageSrc}"/></div>
                <div class="delete-icon" onclick="deleteMsg(this);"><i class="fas fa-times"></i></div>
            </div>
        </div>
    `;

    msgerChat.insertAdjacentHTML("beforeend", ImgHTML);
    msgerChat.scrollTop += 500;
}

function appendOldFile(name, img, side, srcFile, date) {
    //   Simple solution for small apps
    const FileHTML = `
        <div class="msg ${side}-msg">
            <div class="msg-img" style="background-image: url(${img})"></div>

            <div class="msg-bubble">
                <div class="msg-info">
                    <div class="msg-info-name">${name}</div>
                    <div class="msg-info-time">${date}</div>
                </div>

                <div class="msg-text">
                    <div class="uploaded-file">
                        <div class="icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                </path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    <div class="meta"><span></span>
            
                    </div>
                        <div class="action">
                            <a href="${srcFile}" download="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud">
                                    <polyline points="8 17 12 21 16 17"></polyline>
                                    <line x1="12" y1="12" x2="12" y2="21"></line>
                                    <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="delete-icon" onclick="deleteMsg(this);"><i class="fas fa-times"></i></div>
            </div>
        </div>
    `;

    msgerChat.insertAdjacentHTML("beforeend", FileHTML);
    msgerChat.scrollTop += 500;
}