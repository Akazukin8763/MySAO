2022/1/6
-----------------------

修改一些輸入輸出與變數名稱，三個資料夾裡的皆已完成

2022/1/5
-----------------------

已可使用SESSION，三個資料夾裡的皆已完成

2022/1/3
-----------------------

    新增API: getDescription

    新增API: getAincradDetail

2021/12/28
-----------------------

    新增API: updateAbility-更新角色能力

傳入ID與任意想更改的項目
如果傳null就會改為null，(當然除了levels)

    新增API: updatePlayer-更新角色資訊

傳入ID與任意想更改的項目
如果傳null就和不傳一樣不會更新

2021/12/25
-----------------------

    修改API: getAbility-抓ability

改為傳入name，已使用join

    修改API: registerPlayer-註冊player

修改產生ID方法，不受空號與非正規號影響

    新增API: registerAbility-登記ability

傳入ID
因為是剛註冊並檢定完的能力，故傳入ID

    try catch防護

發生錯誤會回傳catch訊息到message.statement

2021/12/22
-----------------------

    新增API: getAbility-抓ability

傳入ID
回傳message類與ability類
若查詢不到會在message.statement顯示訊息

    新增API: registerPlayer-註冊player

傳入name
回傳message類與ID
message.successed代表是否新增成功
message還包含是否 未傳入、命名重複 的失敗資訊

-----------------------