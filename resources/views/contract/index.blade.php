<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shartnoma tuzish</title>
    <link rel="stylesheet" href="{{secure_asset('css/style.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/contract.css')}}">
{{--    <link rel="stylesheet" href="{{asset('css/style.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/contract.css')}}">--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .accept_offer_checkbox{
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Shartnoma tuzish</h1>
    <button id="openContractBtn">Shartnoma tuzish</button>

    <div id="contractOptions" class="hidden">
        <p>Iltimos, o‘zingizni tanlang:</p>
        <button class="option-btn" id="legalEntity">Yuridik shaxslar uchun</button>
        <button class="option-btn" id="individual">Jismoniy shaxslar uchun</button>
    </div>

    <!-- Jismoniy shaxslar uchun forma -->
    <div id="individualForm" class="hidden">
        <fieldset>
            <legend>Jismoniy shaxs uchun shartnoma</legend>
            <h2></h2>
{{--            <form id="individualContractForm" action="{{route('contract.store')}}" method="POST">--}}
            <form id="individualContractForm" action="#" method="POST">
                <div class="mb-3">
                    <input type="text" id="firstName" placeholder="Ism: " name="firstName" class="form-control form-control-sm" aria-label="Ism: "required>
                </div>

                <div class="mb-3">
                    <input type="text" id="lastName" name="lastName" placeholder="Familiya: " class="form-control form-control-sm" aria-label="Familiua" required>
                </div>

                <div class="mb-3">
                    <input type="text" id="passportNumber" name="passportNumber" placeholder="Pasport seriyasi va raqami:" class="form-control form-control-sm" aria-label="passport_number" required>
                </div>

                <div class="mb-3">
                    <input type="tel" id="phone" name="phone" placeholder="Telefon raqam:" class="form-control form-control-sm"  aria-label="phone_number" required>
                </div>

                <div class="mb-3">
                    <textarea id="additionalInfo" name="additionalInfo" placeholder="Qo'shimcha ma'lumot:" class="form-control form-control-sm"></textarea>
                </div>

                <!-- Imzo qo'yish maydoni -->
                <label>Imzo:</label>
                <canvas id="signaturePad"  width="400" height="150" style="border: 1px solid #000;"></canvas>
                <button type="button" id="clearSignature">Imzoni tozalash</button>

                <button type="submit" id="generateContract">Ma'lumotlarni tasdiqlash</button>
            </form>

            <div class="accept_offer_checkbox">
                <div>
                    <div class="form-check mb-3">
                        <input type="checkbox" id="acceptOfferLegal" class="form-check-input" required>
                        <label for="acceptOfferLegal" class="form-check-label">Ommaviy ofertaga roziman</label>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <!-- Yuridik shaxslar uchun forma -->
    <div id="legalEntityForm" class="container py-4 hidden">
        <div class="card-header ">
            <h2 class="text-center">Yuridik Shaxs Uchun Shartnoma</h2>
        </div>
        <div class="card-body">
{{--            <form id="legalEntityContractForm" action="{{ route('contract.store') }}" method="POST" enctype="multipart/form-data">--}}
            <form id="legalEntityContractForm" action="#" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRF himoyasi -->
                @method('POST')
                <div class="mb-3">
                    <label for="companyName" class="form-label">Kompaniya Nomi:</label>
                    <input type="text" id="companyName" name="companyName" class="form-control" placeholder="Masalan: OOO 'Biznes'" required>
                </div>
                <div class="mb-3">
                    <label for="inn" class="form-label">STIR:</label>
                    <input type="text" id="inn" name="inn" class="form-control" placeholder="Masalan: 123456789" required>
                </div>
                <div class="mb-3">
                    <label for="directorName" class="form-label">Rahbarning F.I.O.:</label>
                    <input type="text" id="directorName" name="directorName" class="form-control" placeholder="Masalan: Islomov Akmal Rustamovich" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="example@domain.com" required>
                </div>
                <div class="mb-3">
                    <label for="additionalInfoLegal" class="form-label">Qo'shimcha Ma'lumot:</label>
                    <textarea id="additionalInfoLegal" name="additionalInfo" class="form-control" rows="3" placeholder="Qo'shimcha ma'lumotni kiriting (ixtiyoriy)"></textarea>
                </div>
                <div class="mb-3">
                    <label for="eSignature" class="form-label">Elektron Imzo (E-IMZO tizimi):</label>
                    <input type="file" id="eSignature" name="eSignature" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" id="generateContractLegal" class="btn btn-success">Ma'lumotlarni Tasdiqlash</button>
                </div>
            </form>

        </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title align-content-center justify-content-center display:flex">Shartnoma</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    ARTOVA KOMPANIYASI BILAN SHARTNOMA

                    Shartnoma raqami: __________

                    Shartnoma tuzilgan sana: "___" __________ 20 <b>24</b> yil

                    Tomonlar:
                    1. Ijrochi: "Artova" kompaniyasi, O‘zbekiston Respublikasi qonunchiligiga muvofiq ro‘yxatdan o‘tgan, <b>Toshkent shahar Olmazor tumani</b> manzilda joylashgan, INN <b>3184419421</b>, telefon raqami: <b id="user_phone"></b>, keyingi o‘rinlarda "Ijrochi" deb yuritiladi.
                    2. Buyurtmachi: <b id="user_fullname"> </b>
                    (jismoniy shaxsning F.I.Sh. yoki yuridik shaxsning nomi, manzili, INN), keyingi o‘rinlarda "Buyurtmachi" deb yuritiladi.

                    1. SHARTNOMA PREDMETI

                    1.1. Ushbu shartnoma asosida Ijrochi quyidagi xizmatlarni ko‘rsatishni zimmasiga oladi:
                    - Grafik dizayn (SMM postlar, logotiplar, brending);
                    - Copywriting;
                    - Veb va iOS ilovalarini yaratish.

                    1.2. Buyurtmachi Ijrochining xizmatlaridan foydalanish uchun ushbu shartnoma asosida to‘lovni amalga oshiradi.

                    2. TOMONLARNING HUQUQ VA MAJBURIYATLARI

                    2.1. Ijrochi quyidagilarga majbur:
                    - Buyurtmachining talablariga muvofiq sifatli xizmat ko‘rsatish;
                    - Ishlarni belgilangan muddatlarda bajarish;
                    - Buyurtmachining tijorat sirlarini saqlash.

                    2.2. Ijrochi quyidagilarga haqli:
                    - Ko‘rsatilgan xizmatlar uchun to‘lovni o‘z vaqtida talab qilish;
                    - Buyurtmachi tomonidan xizmat ko‘rsatish jarayonida berilgan ma’lumotlarning aniqligini tekshirish.

                    2.3. Buyurtmachi quyidagilarga majbur:
                    - Xizmat ko‘rsatish uchun zarur bo‘lgan barcha ma’lumotlarni o‘z vaqtida taqdim etish;
                    - Shartnoma shartlariga muvofiq to‘lovlarni o‘z vaqtida amalga oshirish.

                    2.4. Buyurtmachi quyidagilarga haqli:
                    - Ko‘rsatilgan xizmatlarning sifatini tekshirish;
                    - Shartnoma shartlari buzilgan taqdirda, Ijrochidan zararni qoplashni talab qilish.

                    3. TO‘LOV SHARTLARI

                    3.1. Xizmatlar uchun to‘lov hajmi taraflarning qo‘shimcha kelishuvida yoki hisob-fakturada ko‘rsatiladi.

                    3.2. To‘lov bank o‘tkazmasi orqali quyidagi hisob raqamiga amalga oshiriladi:
                    Bank: <b>Biznesni Rivojlantirish banki</b>
                    Hisob raqami: <b>1256413218</b>
                    MFO: <b>Nimadir</b>

                    3.3. To‘lovlar xizmat ko‘rsatish jarayonini boshlashdan oldin yoki tomonlarning kelishuviga ko‘ra bosqichma-bosqich amalga oshiriladi.

                    4. SHARTNOMA MUDDATI

                    4.1. Ushbu shartnoma "___" __________ 20 <b>24</b> yildan kuchga kiradi va tomonlar o‘z majburiyatlarini to‘liq bajargunga qadar amal qiladi.

                    4.2. Tomonlarning kelishuvi asosida shartnoma muddatini uzaytirish yoki o‘zgartirish mumkin.

                    5. NIZOLARNI HAL QILISH TARTIBI

                    5.1. Ushbu shartnoma bo‘yicha kelib chiqadigan barcha nizolar tomonlar o‘rtasida muzokaralar yo‘li bilan hal qilinadi.

                    5.2. Agar muzokaralar natija bermasa, nizo O‘zbekiston Respublikasining amaldagi qonunchiligiga muvofiq sud orqali hal qilinadi.

                    6. BOSHQA SHARTLAR

                    6.1. Ushbu shartnoma ikki nusxada tuzilgan bo‘lib, har bir nusxa tomonlar uchun bir xil huquqiy kuchga ega.

                    6.2. Shartnoma shartlariga kiritiladigan har qanday o‘zgartirish va qo‘shimchalar yozma ravishda amalga oshirilib, tomonlar tomonidan imzolanishi lozim.

                    TOMONLARNING REKVIZITLARI:

                    Ijrochi:
                    "Artova" kompaniyasi
                    Manzil: <b>Toshkent shahar Olmazor tumani</b>
                    INN: <b>3184419421</b>
                    Telefon: <b>+998717777777</b>
                    Vakil: <b>Kimdir</b>
                    (imzo, F.I.Sh.)

                    Buyurtmachi:
                    F.I.Sh./Yuridik nomi: <b id="user_fullname"></b>
                    Telefon: <b id="user_phone_2"></b>
                    Vakil:<img id="user_signature" style="max-width: 100%; border: 1px solid #ccc;" alt="User Signature">
                    (imzo, F.I.Sh.)
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <a class="btn btn-success" id="generatePdfFunc" href="">
                        Generate PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const openContractBtn = document.getElementById("openContractBtn");
        const contractOptions = document.getElementById("contractOptions");
        const legalEntityForm = document.getElementById("legalEntityForm");
        const individualForm = document.getElementById("individualForm");
        const signaturePad = document.getElementById("signaturePad");
        const clearSignature = document.getElementById("clearSignature");
        const modalCanvas = document.getElementById("modalCanvas");

        const myModal = new bootstrap.Modal(document.getElementById('myModal'));

        const acceptOfferLegal = document.getElementById("acceptOfferLegal");


        let firstName = document.getElementById('firstName')
        let lastName = document.getElementById('lastName')
        let passportNumber = document.getElementById('passportNumber')
        let phone = document.getElementById('phone')
        let additionalInfo = document.getElementById('additionalInfo')
        let user_fullname = document.getElementById('user_fullname')
        let user_phone = document.getElementById('user_phone')
        let user_phone_2 = document.getElementById('user_phone_2')
        let generatePdfFunc = document.getElementById('generatePdfFunc')
        let generate_url =  ''
        // Checkboxni tekshirish va modalni chiqarish
        acceptOfferLegal.addEventListener('change', function() {
            if (acceptOfferLegal.checked) {
                console.log([firstName.value + ' ' + lastName.value, phone.value])
                user_fullname.innerText = firstName.value + ' ' + lastName.value
                user_phone.innerText = phone.value
                user_phone_2.innerText = phone.value
                additionalInfo.innerText = additionalInfo.value
                const signatureImage = signaturePad.toDataURL("image/png");

                const signatureData = signaturePad.toDataURL();
                document.getElementById('user_signature').src = signatureData;
                const generate_url = "{{route('generatePdf')}}" +
                    '?first_name=' + encodeURIComponent(firstName.value) +
                    '&last_name=' + encodeURIComponent(lastName.value) +
                    '&phone=' + encodeURIComponent(phone.value) +
                    '&additionalInfo=' + encodeURIComponent(additionalInfo.value) +
                    '&password=' + encodeURIComponent(passportNumber.value) +
                    '&signature=' + encodeURIComponent(signaturePad.toDataURL("image/png"));

                document.getElementById('user_signature').src = signatureData;
                {{--generate_url =  "{{route('generatePdf')}}" + '?first_name='+firstName.value+ '&last_name='+lastName.value+ '&phone='+phone.value+ '&password='+passportNumber.value--}}

                myModal.show();
                generatePdfFunc.setAttribute('href', generate_url)
            }
        });

        const context = signaturePad.getContext("2d");
        let isDrawing = false;

        // Open options
        openContractBtn.addEventListener("click", () => {
            contractOptions.classList.toggle("hidden");
        });

        // Show individual form
        document.getElementById("individual").addEventListener("click", () => {
            // Yangi formani ko'rsatishdan oldin, boshqa formalarni yashirish
            individualForm.classList.remove("hidden");
            legalEntityForm.classList.add("hidden"); // Yuridik shaxslar formasini yashirish
            contractOptions.classList.add("hidden");


        });

        // Show legal entity form
        document.getElementById("legalEntity").addEventListener("click", () => {
            // Yangi formani ko'rsatishdan oldin, boshqa formalarni yashirish
            legalEntityForm.classList.remove("hidden");
            individualForm.classList.add("hidden"); // Jismoniy shaxs formasini yashirish
            contractOptions.classList.add("hidden");
        });

        // Signature pad events
        signaturePad.addEventListener("mousedown", (e) => {
            isDrawing = true;
            context.beginPath();
            context.moveTo(e.offsetX, e.offsetY);
        });

        signaturePad.addEventListener("mousemove", (e) => {
            if (isDrawing) {
                context.lineTo(e.offsetX, e.offsetY);
                context.stroke();
            }
        });

        signaturePad.addEventListener("mouseup", () => {
            isDrawing = false;
            context.closePath();
        });

        signaturePad.addEventListener("mouseout", () => {
            isDrawing = false;
        });

        // Touch events for mobile devices
        signaturePad.addEventListener("touchstart", (e) => {
            e.preventDefault(); // Sahifaning noto'g'ri harakatini oldini olish
            isDrawing = true;
            const rect = signaturePad.getBoundingClientRect();
            const touch = e.touches[0];
            context.beginPath();
            context.moveTo(touch.clientX - rect.left, touch.clientY - rect.top);
        });

        signaturePad.addEventListener("touchmove", (e) => {
            e.preventDefault(); // Sahifaning noto'g'ri harakatini oldini olish
            if (isDrawing) {
                const rect = signaturePad.getBoundingClientRect();
                const touch = e.touches[0];
                context.lineTo(touch.clientX - rect.left, touch.clientY - rect.top);
                context.stroke();
            }
        });

        signaturePad.addEventListener("touchend", () => {
            isDrawing = false;
            context.closePath();
        });

        clearSignature.addEventListener("click", () => {
            context.clearRect(0, 0, signaturePad.width, signaturePad.height);
        });

        document.getElementById("individualContractForm").addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Shartnoma PDF shaklida generatsiya qilinmoqda...");
            // PDF generatsiya va bazaga yuborish logikasi
        });

        document.getElementById("legalEntityContractForm").addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Shartnoma PDF shaklida generatsiya qilinmoqda...");
            // PDF generatsiya va bazaga yuborish logikasi
        });
    });


</script>

</body>
</html>
