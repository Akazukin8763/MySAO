
2021/12/25
-----------------------

    修改API: player註冊

修改產生ID方法，不受空號與非正規號影響


    新增API: ability登記

輸入ID
因為是剛註冊並檢定完的能力，故輸入ID


    執行sql的 try catch 防護

發生錯誤會回傳catch訊息到message.statement

2021/12/22
-----------------------

    新增API: 抓ability

輸入ID
回傳message類與ability類
若查詢不到會在message.statement顯示訊息


    新增API: player註冊

輸入name
回傳message類與ID
message.successed代表是否新增成功
message還包含是否 未輸入、命名重複 的失敗資訊

-----------------------