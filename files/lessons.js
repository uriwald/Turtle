/*
var lessons = [
	{
		title: '',
		steps : [
		{
			title : "",
			explanation : "",
			action : "",
			solution : "",
			hint : ""
		},
		{
			title : "",
			explanation : "",
			action : "",
			solution : "",
			hint : ""
		}
		]
	},
	{
		title: '',
		steps : [
		{
			title : "",
			explanation : "",
			action : "",
			solution : "",
			hint : ""
		},
		{
			title : "",
			explanation : "",
			action : "",
			solution : "",
			hint : ""
		}
		]
	}
];*/
var lessons = [
	{
		title: 'הכר את הצב',
		steps : [
		{
			title : "הצב של לוגו",
			explanation : "שלום, אני תוכנת לוגו. בתיבה השמאלית לתיבה אותה אתה קורא, נמצאת תיבת הציור שלי. " +
					"במרכז תיבת הציור מופיע משולש הנקרא צב. " +
					"פקודות לוגו מאפשרות שליטה בצב ובעזרתו תצייר ציורים מרהיבים. " +
					"את פקודות הלוגו תרשום בתיבה הנמצאית מתחת לתיבת הציור. היא נקראת תיבת הפקודות. " +
					"כדי לכתוב בתיבת הפקודות יש להקליק עליה עם העכבר ולוודא שאנו כותבים בעברית. " +
					"מקשי החיצים מעלה/מטה במקלדת משמשים לחזרה על פקודות קודמות. " +
					"הפקודה הראשונה שתלמד תזיז את הצב קדימה, פקודה זו נקראית בפשטות <b>קדימה</b> ולאחריה מספר. המספר מציין את אורך ההתקדמות.",
			action : "רשום את הפקודה <b>קדימה 50</b>",
			solution : "קד 50",
			hint : ""
		},
		{
			title : "הצב יודע לפנות",
			explanation : "הצב יודע גם לפנות. " +
					"פקודות הפנייה הן <b>שמאלה</b> או <b>ימינה</b> ולאחריהן מספר. " +
					"יש לציין עבור הצב את מעלות הפנייה כאשר סיבוב מלא הוא בזווית של 360 מעלות. " +
					"זווית ישרה היא זווית של 90 מעלות כך שפנייה ישרה שמאלה תבוצע באמצעות הפקודה <b>שמאלה 90</b>.",
			action : "גרום לצב לפנות פנייה ישרה ימינה",
			solution : "ימ 90",
			hint : "אנו רוצים לפנות ימינה בזווית ישרה"
		},
		{
			title : "סיבוב אחורה",
			explanation : "סיבוב אחורה הוא סיבוב של 180 מעלות ואין כאן הבדל בין שמאלה לימינה.",
			action : "פנה אחורה באמצעות הפקודה שמאלה",
			solution : "שמ 180",
			hint : ""
		},	
		{
			title : "האות ר",
			explanation : "האות ר פשוטה מאוד לכתיבה וכפי שניתן לראות, אם יזוז הצב קדימה יושלם ציור האות",
			action : "השלם את האות ר",
			solution : "קד 50",
			hint : "הצלע הראשונה של האות ר הייתה באורך 50"
		},	
		{
			title : "ניקוי המסך",
			explanation : "טרם התחלת ציור חדש, תוכל לנקות את המסך באמצעות הפקודה <b>נקהמסך</b>.",
			action : "נקה את המסך",
			solution : "נמ",
			hint : ""
		},
		{
			title : "חיבור פקודות",
			explanation : "בלוגו ניתן לכתוב כמה פקודות האחת אחרי השנייה ויש להשתמש ברווח בין הפקודות. למשל: <b>ימינה 90 קדימה 50</b>.",
			action : "צייר את האות ר באורך 50, בשורה אחת בלבד הכוללת 3 פקודות",
			solution : "קד 50 שמ 90 קד 50",
			hint : "כדי לצייר את האות ר מספיק להתקדם, לפנות פנייה ישרה שמאלה, ולהתקדם שוב"
		},
		{
			title : "קיצורים",
			explanation : ".ניתן לקצר את הפקודות בהן השתמשנו כבר. במקום ימינה מספיק לכתוב ימ. " +
					"במקום <b>שמאלה</b> מספיק לכתוב <b>שמ</b>. " +
					"במקום <b>קדימה</b> <b>קד</b> ובמקום <b>נקהמסך</b> <b>נמ</b>. " +
					"כעת ניתן לחזור על ציור האות ר בקלות בשורת פקודה יחידה",
			action : "צייר עוד פעם את האות ר באורך 50, בשורה אחת בלבד הכוללת 3 פקודות מקוצרות",
			solution : "קד 50 שמ 90 קד 50",
			hint : "הפתרון דומה לפתרון הקודם אך הפעם אנו משתמשים בגרסה המקוצרת של כל פקודה"
		}
		]
	},
	{
		title: 'שליטה בצב ובעט',
		steps : [
		{
			title : "מהו העט?",
			explanation : "ניתן לדמיין שהצב של לוגו, אותו הכרת בשיעור הקודם, מחזיק בידו עט תוך כדי הליכה. " +
					"בעט הוא משתמש כדי לצייר כאשר הוא מקבל פקודות כמו התקדמות קדימה.",
			action : "בקש מן הצב להתקדם קדימה 30 נקודות וראה את הקו שהוא מצייר",
			solution : "קד 30",
			hint : "אם אינך זוכר, כדאי לחזור על השיעור הראשון"
		},
		{
			title : "הרמת העט",
			explanation : "ניתן לבקש מן הצב להרים את העט כך שכשילך, לא יצוייר שום דבר חדש. הפקודה להרמת העט היא <b>הרםעט</b>.",
			action : "בקש מן הצב להרים את העט",
			solution : "הרםעט",
			hint : ""
		},
		{
			title : "התקדמות ללא העט",
			explanation : "כאשר העט מורם, תזוזת הצב לא תגרום לציור דבר חדש.",
			action : "בקש מן הצב להתקדם עוד 40 נקודות",
			solution : "קד 40",
			hint : ""
		},
		{
			title : "הורדת העט",
			explanation : "ראית שהצב התקדם ללא ציור של קו נוסף. " +
					"כדי להמשיך לצייר יש לפקוד על הצב להוריד בחזרה את העט באמצעות פקודת <b>הורדעט</b>.",
			action : "בקש מן הצב להוריד את העט",
			solution : "הורדעט",
			hint : ""
		},
		{
			title : "התקדמות נוספת עם העט",
			explanation : "העט חזר למצב הקודם וניתן לוודא שהעט אכן מוכן לפעולה.",
			action : "בקש מן הצב להתקדם עוד 40 נקודות",
			solution : "קד 40",
			hint : ""
		},
		{
			title : "החבאת הצב",
			explanation : "לעיתים תוכל לבקש מהצב להתחבא כדי שתוכל לראות את הציור שלך ללא הצב. הפקודה היא <b>החבאצב</b>.",
			action : "בקש מן הצב להתחבא",
			solution : "החבאצב",
			hint : ""
		},
		{
			title : "ציור עם צב חבוי",
			explanation : "מסקנה: צב חבוי וצב גלוי יודעים לצייר באותו האופן. הצב מוצג על המסך רק לנוחותך.",
			action : "בקש מן הצב לפנות בזווית ישרה שמאלה ולהתקדם עוד 40 נקודות",
			solution : "שמ 90 קד 40",
			hint : "זווית ישרה היא זווית של 90 מעלות"
		},
		{
			title : "הצגת הצב מחדש",
			explanation : "אפילו שאפשר תמיד לעבוד בלי לראות את הצב, לרוב נוח יותר לראות אותו ולכן ניתן לבקש את הצגת הצב מחדש באמצעות פקודת <b>הצגצב</b>.",
			action : "גרום לצב להיות מוצג שוב",
			solution : "הצגצב",
			hint : ""
		}
		]
	},
	{
		title: 'רשימות ולולאות',
		steps : [
		{
			title : "ציור ריבוע",
			explanation : "אתה מתבקש לצייר ריבוע באורך 50 נקודות באמצעות פקודות מקוצרות. " +
					"את הריבוע תצייר באמצעות התקדמות ואז פנייה בזווית ישרה שמאלה.",
			action : "צייר ריבוע באמצעות רצף הוראות לוגו המופרד ברווח",
			solution : "קד 50 שמ 90 קד 50 שמ 90 קד 50 שמ 90 קד 50 שמ 90 ",
			hint : "ריבוע הוא מרובע בעל ארבע צלעות שוות אורך. הזווית בין כל שתי צלעות סמוכות בריבוע ישרה. " +
					"שים לב שיש שתי פקודות, <b>קד</b> ואחריה <b>שמ</b>, עליהן אנו חוזרים ארבע פעמים."
		},
		{
			title : "ריבוע עם לולאה",
			explanation : "ייתכן והרגשת כי לא נוח לחזור שוב ושוב על אותן הפקודות. " +
					"כדי שיהיה לך נוח, תוכנת לוגו מאפשרת חזרה על רשימת פקודות באמצעות סוגריים מרובעים. " +
					"לדוגמא, את ציור הריבוע הקודם ניתן לכתוב בצורה פשוטה הרבה יותר כך: <b>חזור 4 [קד 50 שמ 90]</b>. " +
					" המספר אחרי הפקודה <b>חזור</b> מציין כמה פעמים לחזור על רשימת הפקודות. " +
					" את הפקודה <b>חזור</b> וכל רשימת הפקודות עליהן אנו חוזרים, מכנים בשם לולאה. ",
			action : "צייר ריבוע נוסף באורך 100 נקודות אך הפעם השתמש בלולאה",
			solution : "חזור 4 [קד 100 שמ 90]",
			hint : ""
		},
		{
			title : "מתומן עם לולאה",
			explanation : "כפי שמרובע הוא מצולע בעל ארבע צלעות, מתומן הוא מצולע בעל שמונה צלעות. " +
					"כפי שריבוע הוא מרובע שכל צלעותיו שוות באורכן, מתומן משוכלל הוא מתומן שכל צלעותיו שוות באורכן. " +
					"כאשר אומרים לצב של לוגו לפנות בציור מתומן משוכלל, הזווית במתומן תהיה חצי מהזווית בריבוע",
			action : "צייר מתומן שאורך כל צלע שלו 70 נקודות",
			solution : "חזור 8 [קד 70 שמ 45]",
			hint : "חזור על רשימת פקודות בדומה לריבוע, אך יותר פעמים ובזווית של 45 מעלות"
		},
		{
			title : "לולאות מקוננות",
			explanation : "כל פעולה יכולה להתבצע בתוך לולאה. ניתן לכתוב לולאה בתוך לולאה אחרת. " +
					"לולאה המתבצעת בתוך לולאה אחרת נקראית לולאה מקוננת. " +
					"המילה קינון היא אותה המילה כמו בקן של ציפור. " +
					"יהיה מוזר לראות בטבע קן של ציפור בתוך קן של ציפור אבל לא אנחנו החלטנו על המילה. ",
			action : "לפני שתמשיך, נקה בבקשה את המסך",
			solution : "נקהמסך",
			hint : "פקודת ניקוי מסך הופיעה בשיעור קודם"
		},
		{
			title : "ארבעה ריבועים",
			explanation : "המבנה של לולאות מקוננות זהה לזה של הלולאות בהן השתמשנו. " +
					"כך שניתן לרשום למשל <b>חזור 7 [הרםעט קד 10 הורדעט חזור 4 [קד 5 ימ 90]]</b>. ",
			action : "צייר 9 ריבועים בטור אחד. אורך צלע בכל ריבוע תהיה 5 נקודות והרווח בין הריבועים יהיה באורך 8 נקודות.",
			solution : "חזור 9 [הרםעט קד 8 הורדעט חזור 4 [קד 5 ימ 90]]",
			hint : "הדוגמא שנתנו מעלה ללולאה מקוננת די דומה לפתרון"
		},
		{
			title : "קדימה ואחורה",
			explanation : "הפקודה <b>אחורה</b> דומה לפקודה <b>קדימה</b> והקיצור שלה הוא <b>אח</b>",
			action : "נקה את המסך, צייר קו באורך 100 נקודות והחזר את הצב להתחלה",
			solution : "נמ קד 100 אח 100",
			hint : ""
		},
		{
			title : "כוכבית",
			explanation : "הצב חזר למקומו וכעת נבקשך לצייר כוכבית באמצעות לולאה ופקודות אחורה. " +
					"במעגל 360 מעלות כך שאם נרצה כוכבית העשויה מ-20 קווים, נפנה כל פעם ב- 360/20=18 מעלות.",
			action : "צייר כוכבית מ-20 קווים שאורך כל אחד מהם 80 נקודות",
			solution : "חזור 20 [קד 80 אח 80 ימ 18]",
			hint : ""
		},
		{
			title : "מתומנים משוגעים",
			explanation : "עם לולאות אנחנו יכולים לצייר צורות סימטריות משוגעות בקלות רבה מאוד. " +
					"הפעם נצייר 36 מתומנים במעגל באמצעות לולאה כפולה. " +
					"הזווית בה נצטרך לפנות תהיה 360/36=10 מעלות",
			action : "נקה מסך וצייר באמצעות שתי לולאות 36 מתומנים משוכללים כאשר אורך צלע בכל מתומן 50 נקודות",
			solution : "נמ חזור 36 [ימ 10 חזור 8 [קד 50 שמ 45]]",
			hint : "למעלה ראית כיצד לצייר מתומן עם לולאה יחידה וכן כיצד להשתמש בלולאה מקוננת. " +
					"לא לשכוח לנקות מסך בתחילת הפקודה כדי לראות את הצורה היפה."
		}
		]
	},
	{
		title: 'רוחב העט',
		steps : [
		{
			title : "רוחב העט",
			explanation : "עד עכשיו ציירת רק עם עט ברוחב של נקודה אחת ובצבע שחור." +
					" כדי לצייר ציורים יפים יותר נרצה לעיתים לשנות את רוחב העט ואת צבעו. " +
					"כדי לשנות את רוחב העט משתמשים בפקודה <b>שנהרוחב</b> ולאחריה מספר המייצג את רוחב העט החדש בנקודות.",
			action : "קבע את רוחב העט ל-5 נקודות",
			solution : "שנהרוחב 5",
			hint : ""
		},
		{
			title : "קו רחב יותר",
			explanation : "כדי לראות את הקו הרחב יותר יתבקש הצב הנכבד להתקדם מעט",
			action : "צייר קו באורך 50 נקודות",
			solution : "קד 50",
			hint : ""
		},
		{
			title : "רחב יותר",
			explanation : "בוא נשחק עוד מעט עם רוחב העט. ",
			action : "קבע רוחב עט כפול מהקודם וצייר קו באורך 60 נקודות",
			solution : "שנהרוחב 10 קד 60",
			hint : "חמש כפול שתיים"
		},
		{
			title : "פניה באלכסון",
			explanation : "לפני שתמשיך לצייר קווים יתבקש הצב לפנות באלכסון אחורה. " +
					"כל זווית פניה שבין 90 ל-270 מעלות תהיה בעצם פנייה אחורה מהכיוון הנוכחי של הצב.",
			action : "בקש מן הצב לפנות 135 מעלות שמאלה",
			solution : "שמ 135",
			hint : ""
		},
		{
			title : "קו בעובי משתנה",
			explanation : "עכשיו נבקשך לצייר קו עם כמה עוביים שונים. תעזר גם בלולאות אותן למדת קודם. " +
					"המשימה היא לצייר קו באורך 100 נקודות המחולק ל-10 קווים באורך 10 נקודות. " +
					"חצי מהקווים האלו יהיה בעובי 3 נקודות וחצי בעובי נקודה אחת. ",
			action : "באמצעות לולאה אחת צייר את הקו המבוקש.",
			solution : "חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 3 קד 10]",
			hint : "צייר חמש פעמים קו דק ואחריו קו עבה"
		},
		{
			title : "ריבוע מקווקו",
			explanation : "הקו המקווקו אותו ציירת קודם יכול להיות צלע של ריבוע מקווקו. " +
					"כעת תוכל לצייר ריבוע מקווקו שאורך כל צלע בו 100 נקודות. " +
					"כמובן שנעזר בלולאה מקוננת, כפי שלמדנו קודם. ",
			action : "נקה את המסך וצייר ריבוע מקווקו כאשר הפנייה בין הצלעות היא שמאלה",
			solution : "נמ חזור 4 [חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 3 קד 10] שמ 90]",
			hint : "כל צלע בריבוע היא אותו הקו המקווקו מההוראה הקודמת"
		},
		{
			title : "מתומן מקווקו",
			explanation : "אם לא שמת לב עד עכשיו, שימוש בחץ למעלה או למטה של המקלדת מאפשר לנו לראות את הפקודות האחרונות בהן השתמשנו. " +
					"שימוש בחיצים והוספה של פקודות קיימות מאפשרת לנו להתנסות בקלות בשינויים קטנים בהוראות שאנו נותנים לצב. " +
					"רצף ההוראות הניתן לצב נקרא לעיתים קוד. " +
					"למדת בשיעור קודם כיצד לצייר מתומן משוכלל.",
			action : "צייר מתומן משוכלל מקווקו שאורך כל צלע בו 100 נקודות",
			solution : "חזור 8 [חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 3 קד 10] שמ 45]",
			hint : "זווית הפנייה במתומן היא 45 מעלות. לא נתבקשת לנקות את המסך הפעם."
		},
		{
			title : "ריבוע בתוך מתומן",
			explanation : "אם לא ניקית את המסך בין המשימות הקודמות, יכולת לראות שהריבוע שציירת אינו ממש במרכז המתומן. " +
					"כעת נבקש ממך לחשוב מעט יותר איך לצייר ריבוע מקווקו בתוך מתומן מקווקו, כאשר הריבוע בדיוק במרכז המתומן. " +
					"כדי להקל את המשימה נאמר כי המתומן צריך לזוז 71 נקודות ימינה וכדאי להרים את העט בין הצורות. " +
					"המשימה אינה מאוד מסובכת אך כיוון שתרצה לנסות כמה פעמים נדרוש כי תנקה את המסך בתחילת שורת הפקודות. " +
					"גם אם לא הצלחת במשימה הזו, לא נורא. בשיעור הבא תלמד כיצד לעשות לך חיים קלים יותר.",
			action : "צייר ריבוע מקווקו בדיוק במרכזו של מתומן משוכלל מקווקו. " +
					"ראשית צייר את הריבוע. לאחר מכן הזז את הצב ואז צייר את המתומן. ",
			solution : "נמ חזור 4 [חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 3 קד 10] שמ 90] ימ 90 הרםעט קד 71 שמ 90 הורדעט חזור 8 [חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 3 קד 10] שמ 45]",
			hint : "ההוראות שיצרו את הרווח בין הריבוע למתומן הן ימ 90 הרםעט קד 71 שמ 90 הורדעט חזור 8"
		}
		]
	},
	{
		title: 'הצב לומד',
		steps : [
		{
			title : "הפקודה למד",
			explanation : "אם עמדת במשימות השיעור הקודם בהצלחה, וודאי ראית כי לא כל-כך פשוט לערוך את ההוראות שאתה נותן. " +
					"כדי לפשט את התהליך תוכל ללמד את הצב של לוגו סדרת הוראות. " +
					"הלימוד הוא פשוט. רשום את ההוראה <b>למד</b>, אחריה את המילה אותה תרצה שילמד הצב ולבסוף את שורת ההוראות ללימוד. " +
					"למשל: <b>למד מקווקו חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 3 קד 10]</b>" +
					"ביצוע הוראה זו ילמד את הצב מילה חדשה: מקווקו.",
			action : "למד את הצב מהו קו מקווקו באמצעות ההוראה מעלה",
			solution : "למד מקווקו חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 3 קד 10[",
			hint : ""
		},
		{
			title : "הצב תלמיד חרוץ",
			explanation : "כעת תראה שהצב אכן זוכר את מה שלמד. כדי לבקש מהצב לצייר קו מקווקו, פשוט חזור על מילת ההוראה החדשה. ",
			action : "צייר קו מקווקו באמצעות ההוראה החדשה שלימדת את הצב",
			solution : "מקווקו",
			hint : "רשום רק את מילת ההוראה"
		},
		{
			title : "ריבוע מקווקו",
			explanation : "אומנם ציירת ריבוע מקווקו קודם, אך כעת המשימה תהיה קלה הרבה יותר. " +
					"השתמש במילה שלימדנו את הצב לצייר ריבוע",
			action : "צייר ריבוע מקווקו באמצעות 4 קווים ופניות ימינה",
			solution : "חזור 4 [ימ 90 מקווקו]",
			hint : "אם שכחת איך לצייר ריבוע, כדאי לחזור קצת אחורה בשיעורים"
		},
		{
			title : "למד את הריבוע",
			explanation : "כיוון שאולי תרצה שוב לצייר את אותו הריבוע, תוכל ללמד את הצב מהו הריבוע שאתה אוהב.",
			action : "בקש מן הצב ללמוד איך לצייר ריבוע כמו זה שציירת קודם",
			solution : "למד ריבוע חזור 4 [ימ 90 מקווקו]",
			hint : ""
		},
		{
			title : "ריבוע במילה אחת",
			explanation : "כעת תוכל לצייר ריבוע מקווקו בקלות באמצעות מילה יחידה. ",
			action : "נקה את המסך וצייר את אותו הריבוע המקווקו",
			solution : "נמ ריבוע",
			hint : "רק שתי הוראות"
		},
		{
			title : "עשרים ריבועים מקווקווים",
			explanation : "הצורה הסימטרית המוזרה הבאה שנצייר תהיה מורכבת מ-20 ריבועים מקווקווים." +
					"בין כל ריבוע לריבוע נפנה ימינה 360/20=18 מעלות. " +
					"נזכור שהצב יודע לצייר ריבוע מקווקו כך שלנו נותר רק להגדיר נכון את הלולאה שתצייר את הריבועים",
			action : "נקה מסך וצייר עשרים ריבועים מקווקים",
			solution : "נמ חזור 20 [ימ 18 ריבוע]",
			hint : ""
		},
		{
			title : "שינוי הקו המקווקו",
			explanation : "לימדת את הצב מהו הקו המקווקו שאתה אוהב אך ייתכן ותרצה לפתע קו מקווקו אחר. " +
					"במקרה כזה תוכל ללמד את הצב שוב את אותה המילה אך הפעם עם הוראות שונות. " +
					"הצב יזכור רק את ההוראות האחרונות שלמד.",
			action : "למד את הצב מחדש מהו קו מקווקו באמצעות הוראה דומה לזו שבתחילת השיעור אלא שהפעם רוחבם של המקטעים העבים יהיה 6 נקודות במקום 3",
			solution : "למד מקווקו חזור 5 [שנהרוחב 1 קד 10 שנהרוחב 6 קד 10]",
			hint : ""
		},
		{
			title : "גם הריבוע השתנה",
			explanation : "למה לבדוק את הקו המקווקו החדש כשאפשר כבר לבדוק איך נראה ריבוע של קווים מקווקווים? " +
					"בקש מלוגו לצייר ריבוע ושים לב איך הוא שונה מהריבוע אותו צייר לוגו קודם לכן באמצעות אותה הוראה פשוטה.",
			action : "צייר ריבוע באמצעות ההוראה אותנו לימדנו את הצב",
			solution : "ריבוע",
			hint : ""
		}
		]
	} /*, Future lessons
	
		{
		title: 'לולאות עם מונה',
		steps : [
		{
			title : "הדפסת המספרים הזוגיים",
			explanation : "פקודת הדפס מציגה את המילה שכתובה אחריה. " ,
			action : " הצג את המספרים הזוגיים בין 1-10" ,
			solution : "הדפס 2 הדפס 4 הדפס 6 הדפס 8 הדפס 10",
			hint : "השתמש בפקודה הדפס כמה פעמים על מנת לקבל את הפלט המבוקש"
		},
		{
			title : "הדפסה על ידי לולאת עבור",
			explanation : "לולאת עבור בנוייה באופן הבא",+
				"עבור [שם-משתנה ערך-תחילי-של-משתנה תנאי-עצירה צעד] [בצע פקודות*]*",
			action : "רשום את הפקודה הבאה עבור ", +
				"עבור [מונה 2 10 2] [הדפס :מונה] "
			solution : "עבור [מונה 2 10 2] [הדפס :מונה]",
			hint : ""
		},
		{
			title : "ציור מבוך",
			explanation : " נשתמש בלולאת עבור כדי ליצור צורה של מבוך פשוט" +
				"נתקדם קדימה סכום מסויים ונפנה ימינה 90 ואז נתקדם קדימה סכום גדול יותר",
			action : "עבור[גודלמשתנה 0 200 10] [קדימה : גודלמשתנה ימינה 90]",
			solution : "",
			hint : ""
		},
		{
			title : "ציור ריבועים בעלי דפנות משותפות",
			explanation : "נצייר ריבוע בגודל 10 ואחריו ריבוע בגודל 20 וריבוע בגודל 30 עד שהגודל של הריבוע יהיה שווה ל 100 על ידי לולאת עבור"+
				"נשתמש בפקודת למד כדי ליצור ריבוע שמקבל פרמטר כניסה" +
				"למד ריבוע :אורך חזור 4 [קדימה :אורך ימינה 90]",
			action : "עבור  [אורך 10 100 10] [ריבוע :אורך]  ",
			solution : "עבור  [אורך 10 100 10] [ריבוע :אורך] ",
			hint : "במקרה ואינך זוכר את הפקודה למד חזור לשיעורים קודמים"
		}
		]
	}*/
];

