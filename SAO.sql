-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-20 10:31:08
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `mysao`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ability`
--

CREATE TABLE `ability` (
  `ID` char(8) NOT NULL,
  `health` int(16) NOT NULL,
  `attack` int(16) NOT NULL,
  `defense` int(16) NOT NULL,
  `reaction` int(16) NOT NULL,
  `agile` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ability`
--

INSERT INTO `ability` (`ID`, `health`, `attack`, `defense`, `reaction`, `agile`) VALUES
('CR000001', 487, 126, 10, 99999, 50);

--
-- 觸發器 `ability`
--
DELIMITER $$
CREATE TRIGGER `check_ID` AFTER INSERT ON `ability` FOR EACH ROW BEGIN
	IF(NEW.ID NOT IN ((SELECT ID
                       FROM player)
                        UNION
                       (SELECT ID
                       FROM enemy)))
	THEN
		SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'ID does not exist';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `aincrad`
--

CREATE TABLE `aincrad` (
  `levels` int(8) NOT NULL COMMENT '樓層數',
  `main_area` varchar(32) DEFAULT NULL COMMENT '主街區名稱',
  `main_description` varchar(512) DEFAULT NULL COMMENT '主街區特徵',
  `major_area` varchar(32) DEFAULT NULL COMMENT '重要地點名稱',
  `major_description` varchar(512) DEFAULT NULL COMMENT '重要地點特徵',
  `landscape_description` varchar(512) DEFAULT NULL COMMENT '樓層景物特徵'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `aincrad`
--

INSERT INTO `aincrad` (`levels`, `main_area`, `main_description`, `major_area`, `major_description`, `landscape_description`) VALUES
(1, '起始之街', NULL, '托爾巴納', '離迷宮區不遠的山谷裏的最繁榮的城鎮。', '街道的周圍是野豬和狼一類的動物型怪物以及蠕蟲、甲蟲、黃蜂系等的蟲型怪物經常出沒的草原地域。往西北方向穿過草原則有一片寬闊而深邃的森林，再往東北部移動則是湖沼地帶。穿過湖沼就可以看到山川、低谷、遺蹟。不同的地域都相應地棲息着一羣怪物，位於最下面的第一層，最為寬闊。'),
(2, '烏爾巴茲', '一座把直徑約300米的環狀山中間掏空只留下外圍的城鎮。', '馬隆', '往此街道東南方向偏離3千米的地方坐落着的小村莊。', '直徑與第一層相差無幾，是被草原以及岩石所支配的熱帶地域。小山林立，有許多小型洞窟，洞窟中流淌着地下水脈。第二層分為遼闊的北部地區和狹窄的南部地區兩個部分，西側的平原是棲息著大量野牛怪物的危險區域，穿過西部，會進入遊蕩着更高級的怪物的荒地區域。'),
(3, '茲姆福特', '裏面有三株生長在一起的紫衫樹。森林的南端和北端分別是森林精靈、黑暗精靈的野營地，二者為SAO第一個大型戰役任務的據點。黑暗精靈野營地內部設有用於住宿的帳篷、食堂和浴場，任務中的玩家無需返回城鎮。若要到北側區域內的迷宮區，則需打倒在中央山脈中僅有的一處山谷內築巢的野外BOSS。', '迷霧森林', '位於樓層南部，濃厚的大霧很容易讓玩家迷失方向。地圖顏色則會變得非常暗淡，難以看清。', '設計的主題是「森林」，與第一層的「霍倫卡村」周邊、第二層「南方地區」的森林在規模和迫力上都差別很大，巨大的古樹覆蓋着第三層全部的土地。'),
(4, '羅維爾', NULL, NULL, NULL, '封測時的第四層設計主題，是乾巴巴的峽谷如蜘蛛網一般佈滿四周的所謂「涸谷」領域。正式開服後，第四層樓層的設計主題變成了「水路」。主街區被稱為「羅維爾」，其東南面有一片廣闊的森林地帶。沿着水路南下後，則有直徑高達三百米的「卡爾德拉湖」。再往下行，便能到達最上層棲息着樓層頭目的「迷宮區巨塔」。'),
(5, '卡爾路因', '第五層的主街區「卡爾路因」被建築於樓層南部的巨大遺蹟的中央部。用發藍的岩石質建築材料堆砌而成的建築物雖然各處都瀕臨倒塌，但在街區中心部，用皮革和布做的帳篷遍佈了道路兩側，呈現出了雜亂的活力。在距卡爾路因不遠的神殿遺蹟和廣場，能夠撿到寶石和飾品等「遺物」。', NULL, NULL, '第五層的設計主題是「遺蹟區域」。直徑近十公里的場景裏，自然地形不過三成左右，餘下全部都是如迷宮般的遺蹟。與之前橫向擴展的樓層相異，縱向延伸是這一層的特徵。延伸到地下墓地及下方的遺蹟迷宮、通過挖掘到地面之下造出的街道等等，各自皆如地下迷宮般錯綜複雜，而且照明格外昏暗，封測時經常發生PK。'),
(6, '史塔基翁', NULL, NULL, NULL, NULL),
(7, NULL, NULL, '怪獸鬥技場', NULL, NULL),
(8, '弗立班', NULL, NULL, NULL, '艾恩葛朗特第八層是森林的樓層，第三層雖然也以森林為主體，但相對於那邊有不少的草原和巖場，第八層徹底被森林所覆蓋，更何況，地面並不存在，整個樓層都被深水覆蓋而不可能步行，取而代之的是驚人的巨大樹木向四面八方伸出的巨大枝條，以及人工架設的無數吊橋，玩家就藉由這些空中通路來移動。若大意掉下去的話，就得在水中四處遊移尋找有梯子的樹木才行。\r\n這個樓層伸展的巨樹枝梢會碰到第九層的底部，這是少屬幾個努力爬樹就能碰到上層底部的樓層之一，當然挖出隧道是沒人能辦到的。'),
(9, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, '千蛇城', '第十層的迷宮區', NULL),
(11, '塔夫託', NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, NULL, NULL, NULL),
(19, '拉貝爾克', NULL, '十字之丘', '走出主街區後約二十分鐘路程的小山丘，小山丘頂部上面只長着一棵歪七扭八的矮樹，樹下是已經風化，長滿青苔的十字形石制墓碑。', NULL),
(20, NULL, NULL, '向陽森林', NULL, NULL),
(21, NULL, NULL, NULL, NULL, NULL),
(22, '高拉爾', '規模可説只是一個非常小的村落。', '森之屋', '亞絲娜與桐人的小屋，大約位在樓層的南端，接近外圍的地方。', '第二十二層面積相當寬廣，以直徑來説，應該有八公里多。常綠樹森林與散佈在各處的無數湖泊佔據了大部分土地，中央有巨大的湖泊，南岸是主要街道區「高拉爾」村，北岸則是迷宮區。除此之外的地方全是美麗的針葉樹林。與其説是個城鎮不如説是個小村莊。將圈內和圈外分開的邊界是高只有一米半的木柵欄，而所有的建築物都是木製。就連村子中央的轉移門都是用磨好的圓木構成，實在是太徹底了。居民很少。'),
(23, NULL, NULL, NULL, NULL, NULL),
(24, '帕那雷澤', '主街區「帕那雷澤」的設計構築是在巨大的湖中央構建起人工島，再從島出發向四面八方伸展出細長的浮橋，連接起無數的小島。', NULL, '在主街區稍微往北一點，有個長着巨大的樹的觀光景點的小島。', '第二十四層是大部分被水面覆蓋的湖沼系樓層。'),
(25, '吉爾德斯坦', '在浮游城裏少見的大都市式的城鎮。', NULL, NULL, NULL),
(26, NULL, NULL, NULL, NULL, NULL),
(27, '隆巴爾', '「隆巴爾」是夜之精靈們的城鎮，契合這個設定，巨大的建築一個也不沒有。樓層全體佈滿了堅硬的巖山，街道和地城都是挖空巖山所打造的，礦石道具非常容易入手，是職人玩家們羣聚的樓層，青色石制的小小的工房、商店還有旅館的房檐緊緊相連，這些在橘黃色的燈光照射下的光景同時帶有着幻想般的美麗和夜祭般的熱鬧。', NULL, NULL, '第二十七層是常暗之國。外圍的開口部極其之少，即使在白天也等同於沒有陽光照入。內部有眾多的凹凸不平石頭山從上層的底部伸出，在那上面左一處右一處長處來的巨大水晶六稜柱發出朦朧的藍色光芒。'),
(28, NULL, NULL, '狼原', NULL, NULL),
(29, NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, NULL, NULL),
(31, NULL, NULL, NULL, NULL, NULL),
(32, NULL, NULL, NULL, NULL, NULL),
(33, NULL, NULL, NULL, NULL, NULL),
(34, NULL, NULL, NULL, NULL, NULL),
(35, '密歇', '並排着白牆壁紅屋頂的房子，充滿了牧歌風情、農村的氣氛。', '迷路森林', '第三十五層北邊的廣大森林地帶。由茂密的巨大樹木並列而成的森林以棋盤狀分割成數百個區塊，並且被設定為在踏入其中一塊區域一分鐘後，四周鄰接區塊的連結就會隨機變換。', NULL),
(36, NULL, NULL, NULL, NULL, NULL),
(37, NULL, NULL, NULL, NULL, NULL),
(38, NULL, NULL, NULL, NULL, NULL),
(39, '諾爾弗雷特', '相較浮游城的其他樓層而言並沒有特別明顯的特徵，是典型的‘奇幻異世界的鄉村小鎮’。同時，由於餐廳和酒館稀少的原因，本部在此處時的血盟騎士團成員對其評價普遍不高。', NULL, '第三十九層鄉下城鎮的一棟很小的房子裏曾是血盟騎士團的本部。\r\n樓層東北部一片平緩的丘陵地帶：這片丘陵白天只有很弱的植物系怪物從兩側刷新，因此是相當安全的場所。但有情報説這裏一到晚上就會完全變個樣子。', '這層有很多樹林以及河流，紅色屋頂的小房子連成一片，非常可愛。城鎮大門外面的野區礦石和草藥的採集點十分豐富。怪物大多攻低防高，最為戰鬥訓練的對手最合適不過。還會大量刷新掉落上等革素材和鱗素材的怪物。'),
(40, '傑伊雷烏姆', '設定上曾是巨大的監獄，街區四面被高達二十米的石牆圍起來，整體有些偏暗。夜裏的照明也有限，四處殘留的鐵柵欄每次開閉都會發出刺耳的響聲。', NULL, NULL, '幾乎所有的商店和餐館都是由過去的牢房改造的。大門和窗户都是鐵柵欄，牆壁和天花板也是深灰色的石壁。坐在店裏吃飯感覺自己不是客人，而是囚犯。但是外面的露天座位環境稍微好一點。'),
(41, NULL, NULL, NULL, NULL, NULL),
(42, NULL, NULL, NULL, NULL, NULL),
(43, NULL, NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, NULL, NULL),
(45, NULL, NULL, NULL, NULL, NULL),
(46, NULL, NULL, '螞蟻谷', '全長三十公尺左右，周圍的山崖上開着數個洞的巢穴。', NULL),
(47, '芙洛莉雅', '「芙洛莉雅」的轉移門廣場上，遍佈無數的花朵。狹窄的道路以十字貫穿圓形的廣場，其它地方則是用磚塊圍成的花圃，不知名的花草在其中爭奇鬥豔。', '回憶之丘', '第四十七層南邊的圈外迷宮，一座橫跨小河的小橋的另一端的一座有點高的山丘，道路環繞着山丘連綿至丘頂，丘頂上開的花是可以使使魔復活的道具。', '此層被稱為「花之庭園」，不光是街道，整個樓層都佈滿了花朵。'),
(48, '琳達司', '有着縱橫交錯的水路和到處都裝設着水車的構造，白天時街道上到處都能聽見的鍛造屋的槌聲。', '艾什莉的裁縫店', '艾什莉是艾恩葛朗特中第一個把裁縫技能修習到滿點的職人，被稱艾因葛朗特NO.1的名裁縫，也是個二十出頭的美人，只接受中意的訂單。裁縫店開在樓層的北區，有兩座水車，面積是「莉茲貝特武器店」的三倍。', NULL),
(49, '繆基恩', NULL, NULL, NULL, NULL),
(50, '阿爾格特', '如果要簡單用一句話來形容「阿爾格特」街道，那真的就只有「雜亂」兩個字了。這裏沒有任何像「起始之街」那樣的大型設施，廣大面積裏由無數小路重重疊疊穿插在其中，還有許多不知道究竟賣些什麼的工作室，以及看起來好像進去之後就出不來的旅館。', '阿爾格特軒', '「阿爾格特」的下町的深處的深處再更深處，稍微吹點強風就會「啪夏!」的倒下似的拼板做的建築物，入口是一扇拉門配上門簾，店內鋪着石材地板――還不如説是裸露出來的水泥地板，四人座的桌子兩張，櫃枱席四個。店內的擺設，甚至讓人以為是不是故意特別裝飾成窮酸的樣子。菜單隻有三種：「阿爾格特面」「阿爾格特燒」「阿爾格特煮」的這種完全沒幹勁的命名方式，再加上看起來拉麪卻又不是拉麪的東西，看起來像什錦燒卻又不是什錦燒的東西，都是像這種讓人搞不懂到底是啥的食物。（其實是因為缺少醬油。）', NULL),
(51, NULL, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, NULL, NULL),
(53, NULL, NULL, NULL, NULL, NULL),
(54, NULL, NULL, NULL, NULL, NULL),
(55, '格朗薩姆', '「格朗薩姆」市又稱「鐵之都」。因為與其它城鎮大多是由石頭建造而成不同，這個城鎮的主要建築物——巨大尖塔，全用閃爍着黑色光芒的鋼鐵建造而成。雖然因為冶煉與雕金工藝相當興盛而有許多玩家定居於此，但完全沒有行道樹的街道，在這個秋意漸濃的時節裏，讓人有種風一吹就特別寒冷的印象。', '血盟騎士團公會總部。', NULL, '第五十五層的主題是冰雪地帶，練功區是植物非常稀少的乾燥荒野。正下方是美麗的圓錐形雪山。稍遠處有個小村子。在廣大雪原與深邃森林的另一側，主要街道區的每户人家那尖尖的屋頂並排着。'),
(56, '帕尼', NULL, '聖龍聯合公會總部。', NULL, '被認為是很平和而沒有什麼特徵的樓層'),
(57, '瑪汀', NULL, NULL, NULL, '主街區上遍佈着像餐廳，教堂一類的高大建築，晚上的時候非常熱鬧。五十七層主街區「瑪汀」外，是片零星生長着枝繁葉茂的古樹的草原。'),
(58, NULL, NULL, NULL, '那座滿是冰雪的山野，是位於五十八層一端的某座山頂，不過要登山那座山必須攀爬那條能夠遇到許多怪獸的長長山路，而且路的盡頭還有區域BOSS冰龍守候在那。', NULL),
(59, '達納庫', NULL, NULL, NULL, NULL),
(60, NULL, NULL, NULL, NULL, NULL),
(61, '塞爾穆布魯克', '「塞爾穆布魯克」規模雖然不大，但全部由白色花崗岩精緻打造而成，有華麗尖塔古城為中心的市街，與點綴其中的多數綠地形成美麗對比，市場裏商店種類也相當豐富。', '亞絲娜的家', NULL, '第六十一層的面積幾乎全被湖水佔據，而塞爾穆布魯克則是存在於湖中心的小島。被通稱為「蟲蟲大陸」，和名字一樣，這層都被蟲型怪獸所充斥。'),
(62, NULL, NULL, NULL, NULL, NULL),
(63, NULL, NULL, NULL, NULL, NULL),
(64, NULL, NULL, NULL, NULL, NULL),
(65, NULL, NULL, NULL, NULL, '以恐怖系樓層聞名的古城迷宮。'),
(66, NULL, NULL, NULL, NULL, '與六十五層相同主題的恐怖系樓層。'),
(67, NULL, NULL, NULL, NULL, NULL),
(68, NULL, NULL, NULL, NULL, NULL),
(69, NULL, NULL, NULL, NULL, NULL),
(70, NULL, NULL, NULL, NULL, NULL),
(71, NULL, NULL, NULL, NULL, NULL),
(72, NULL, NULL, NULL, NULL, NULL),
(73, NULL, NULL, NULL, NULL, NULL),
(74, '卡姆戴托', NULL, NULL, NULL, '穿越林列着錯綜複雜古樹的森林之後，出現於眼前的是有許多淺藍色花朵的草原。道路貫穿整個草原往西延伸，底端則可以看到第七十四層的迷宮區。聳立在草原另一端的巨塔，是由紅褐色砂岩所構成的圓形建築物。'),
(75, '科力尼亞', '主要街道區「科力尼亞」裏，都是古羅馬風格的建築物。街道是由切成四角型的白色石灰岩堆積起來建造而成。與神殿風格建築物、寬廣水道並稱為城鎮象徵的，是一座矗立在轉移門前的巨大競技場。', NULL, NULL, '第七十五層迷宮區是由類似有點透明感的黑曜石材質所構成。與下層迷宮那種粗略切割過的凹凸不平表面不同，這裏的地板是由磨得像鏡子一樣的黑色石頭呈直線狀排列而成。'),
(76, '大索菲亞', NULL, '死者的大釜', '第76層的迷宮區。', NULL),
(77, '特里貝利亞', NULL, '身纏珠寶的殺戮者的迷宮', '第77層的迷宮區。', NULL),
(78, '魯涅特', NULL, '惡鬼的魔窟', '第78層的迷宮區。', NULL),
(79, '埃因歐德魯', NULL, '奔波的龍宮', '第79層的迷宮區。', NULL),
(80, '卡里安那', NULL, '求魂怪物們的迷宮', '第80層的迷宮區。', NULL),
(81, NULL, NULL, '絕頂強者們的迴廊', '第81層的迷宮區。', NULL),
(82, NULL, NULL, '剛硬的石窟', '第82層的迷宮區。', NULL),
(83, NULL, NULL, '強欲盜賊的王國', '第83層的迷宮區。', NULL),
(84, NULL, NULL, '暴食的寢座', '第84層的迷宮區。', NULL),
(85, NULL, NULL, '清流的石窟', '第85層的迷宮區。', NULL),
(86, NULL, NULL, '遺忘之戰的司令塔', '第86層的迷宮區。', NULL),
(87, NULL, NULL, '貪食的根城', '第87層的迷宮區。', NULL),
(88, NULL, NULL, '隸屬民們的勞動場', '第88層的迷宮區。', NULL),
(89, NULL, NULL, '濁流的靈廟', '第89層的迷宮區。', NULL),
(90, NULL, NULL, '仄暗復仇鬼封印塔', '第90層的迷宮區。', NULL),
(91, NULL, NULL, '彗眼的奇窟', '第91層的迷宮區。', NULL),
(92, NULL, NULL, '剛健守護者的迷宮', '第92層的迷宮區。', NULL),
(93, NULL, NULL, '鋼弦的魔樓', '第93層的迷宮區。', NULL),
(94, NULL, NULL, '黑暗騎士的寢所', '第94層的迷宮區。', NULL),
(95, NULL, NULL, '賽勒斯', '第95層的迷宮區。', NULL),
(96, '維魯特斯', NULL, '聖騎兵的劍堂', '第96層的迷宮區。', NULL),
(97, '菲而基亞', NULL, '極死王的靈柩', '第97層的迷宮區。', NULL),
(98, '海恩修德', NULL, '通往紅玉的試煉', '第98層的迷宮區。', NULL),
(99, '終結之城鎮', NULL, '紅玉擁抱生苦的場所', '第99層的迷宮區。', NULL),
(100, NULL, NULL, '紅玉宮', '艾恩葛朗特最上層有一座擁有華麗尖塔的巨大鮮紅宮殿屹立。', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `enemy`
--

CREATE TABLE `enemy` (
  `ID` char(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `levels` int(8) DEFAULT NULL,
  `is_boss` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `enemy`
--

INSERT INTO `enemy` (`ID`, `name`, `description`, `levels`, `is_boss`) VALUES
('EM000101', '狗頭人領主', '武器是骨斧、皮革小圓盾、大太刀。', 1, 1),
('EM000102', '廢墟狗頭人衛兵', '身著金屬重甲、手持斧槍，它們通常都是三頭一起出現。', 1, 0),
('EM000201', '金牛國王亞斯特留斯', '金牛族能連續使出產生麻痹效果的劍技「麻痹衝擊」和「麻痹爆破」。', 2, 1),
('EM000202', '金牛上將巴蘭', '金牛族能連續使出產生麻痹效果的劍技「麻痹衝擊」和「麻痹爆破」。', 2, 0),
('EM000203', '金牛上校納托', '金牛族能連續使出產生麻痹效果的劍技「麻痹衝擊」和「麻痹爆破」。', 2, 0),
('EM000301', '惡魔樹精涅里烏斯', '具有大型樹木般的姿態，能夠釋放大範圍毒化技能。', 3, 1),
('EM000401', '海馬維斯格', '注水，一招能讓整個大廳為水所淹沒的可怕技能，另外頭目使用能力後，房間的門會關上，雖然絕對不能從內側打開，不過在對它施加一定值以上的水壓的狀態下，只要從外側一拉大門就能簡單地打開。', 4, 1),
('EM000501', '空虛巨像·福斯克斯', '整個第五層的BOSS房間都是該BOSS的身體，該BOSS擁有使視覺亮度下降、聽覺下降、平衡感下降、HP漸減等等的debuff吼叫，另外該BOSS房間會出現藍色線條，當玩家觸碰到藍色線條，隱藏在地板下的手與隱藏在天花板上的腳會對玩家發動攻擊，當BOSS血量進入第六根時，BOSS會變成人形的石巨人，從天花板上分離出來。\r\nRPG中常見的石巨人怪物，但是這個BOSS卻具有從未見過的攻擊模式，能夠配合寬敞的房間，接連不斷地放出複雜的地毯式機關，讓攻略隊伍吃盡苦頭。', 5, 1),
('EM000601', '荒謬方塊', NULL, 6, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `guild`
--

CREATE TABLE `guild` (
  `guild_ID` char(8) NOT NULL,
  `guild_name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `guild`
--

INSERT INTO `guild` (`guild_ID`, `guild_name`) VALUES
('GD000001', '月夜黑貓團'),
('GD000002', '血盟騎士團');

-- --------------------------------------------------------

--
-- 資料表結構 `player`
--

CREATE TABLE `player` (
  `ID` char(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `levels` int(8) DEFAULT NULL,
  `guild_ID` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `player`
--

INSERT INTO `player` (`ID`, `name`, `description`, `levels`, `guild_ID`) VALUES
('CR000001', '桐谷和人', '封閉者', 1, NULL),
('CR000002', '結城明日奈', '血盟騎士團副團長', 1, 'GD000002');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `aincrad`
--
ALTER TABLE `aincrad`
  ADD PRIMARY KEY (`levels`);

--
-- 資料表索引 `enemy`
--
ALTER TABLE `enemy`
  ADD PRIMARY KEY (`ID`,`name`),
  ADD KEY `levels` (`levels`);

--
-- 資料表索引 `guild`
--
ALTER TABLE `guild`
  ADD PRIMARY KEY (`guild_ID`);

--
-- 資料表索引 `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `levels` (`levels`),
  ADD KEY `guild_ID` (`guild_ID`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `enemy`
--
ALTER TABLE `enemy`
  ADD CONSTRAINT `enemy_ibfk_1` FOREIGN KEY (`levels`) REFERENCES `aincrad` (`levels`) ON UPDATE CASCADE;

--
-- 資料表的限制式 `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`levels`) REFERENCES `aincrad` (`levels`) ON UPDATE CASCADE,
  ADD CONSTRAINT `player_ibfk_2` FOREIGN KEY (`guild_ID`) REFERENCES `guild` (`guild_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;