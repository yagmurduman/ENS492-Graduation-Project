from monkeylearn import MonkeyLearn
import json

def extractKeywords(text):	
	ml = MonkeyLearn('22517538b038890ffe7ed457e8dfc8ef52edbe5a')

	text = text.replace("&lt;p&gt;", "")
	data = [text]
	model_id = 'ex_YCya9nrn'
	result = ml.extractors.extract(model_id, data)

	json_dict = result.body[0]
	extractions = json_dict["extractions"]

	extracted = extractions[0]["parsed_value"] + " " + extractions[1]["parsed_value"] + " " + extractions[2]["parsed_value"]

	return extracted
