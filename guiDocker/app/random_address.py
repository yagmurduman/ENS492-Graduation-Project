"""
Input: country
Output: address and phone number

valid countries = {'Guatemala', 'Rwanda', 'Macao SAR China', 'Panama', 'Antigua  Barbuda', 'Burkina Faso', 'St. Martin', 'Bahrain', 'Bulgaria', 'El Salvador', 'Belgium', 'San Marino', 'Guernsey', 'Algeria', 'Monaco', 'Slovakia', 'Cambodia', 'Tunisia', 'Sint Maarten', 'Kazakhstan', 'Laos', 'Hong Kong', 'Mongolia', 'Benin', 'Zambia', 'Kenya', 'North Macedonia', 'Chile', 'Vietnam', 'Aland Islands', 'Japan', 'Cook Islands', 'Colombia', 'Moldova', 'St. Pierre  Miquelon', 'Thailand', 'French Guiana', 'Honduras', 'New Caledonia', 'Papua New Guinea', 'Comoros', 'Uruguay', 'Andorra', 'South Korea', 'Congo - Kinshasa', 'Afghanistan', 'Greenland', 'Turkmenistan', 'Israel', 'Czechia', 'Djibouti', 'Bolivia', 'Grenada', 'GU', 'Senegal', 'St. Lucia', 'British Virgin Islands', 'Burundi', 'Poland', 'Canada', 'Albania', 'Bahamas', 'Georgia', 'Russia', 'Portugal', 'Trinidad  Tobago', 'Pakistan', 'Angola', 'Botswana', 'Singapore', 'India', 'Venezuela', 'Egypt', 'Gambia', 'PR', 'Aruba', 'Mexico', 'Seychelles', 'Guadeloupe', 'Cameroon', 'China', 'Sierra Leone', 'Romania', 'Bermuda', 'Italy', 'Barbados', 'Faroe Islands', 'Greece', 'Denmark', 'Maldives', 'Nigeria', 'Germany', 'Nicaragua', 'Nepal', 'Namibia', 'Uganda', 'Malta', 'France', 'Fiji', 'Ecuador', 'Curacao', 'Togo', 'Sri Lanka', 'Cayman Islands', 'Tajikistan', 'Jamaica', 'Saudi Arabia', 'Philippines', 'Sweden', 
'Martinique', 'Mauritania', 'Australia', 'Ireland', 'Mauritius', 'Ethiopia', 'Iran', 'Mayotte', 'Libya', 'Uzbekistan', 'Reunion', 'Ukraine', 'Samoa', 'United Arab Emirates', 'Lithuania', 'Haiti', 'Finland', 'Madagascar', 'Cyprus', 'Austria', 'Tanzania', 'Falkland Islands', 'Peru', 'Armenia', 'Kuwait', 'Palestinian Territories', 'Anguilla', 'United States', 'Hungary', 'Brazil', 'Cote d’Ivoire', 'Azerbaijan', 'Eswatini', 'Morocco', 'Belarus', 'Liechtenstein', 'Turkey', 'MP', 'Suriname', 'Latvia', 'Brunei', 'South Africa', 'Belize', 'Croatia', 'Jordan', 'Spain', 'Luxembourg', 'VI', 'United Kingdom', 'Vanuatu', 'Isle of Man', 'Oman', 'Gibraltar', 'Costa Rica', 'Ghana', 'Switzerland', 'Iceland', 'French Polynesia', 'Iraq', 'Malaysia', 'Mali', 'Estonia', 'New Zealand', 'Serbia', 'Lebanon', 'Norway', 'St. Barthelemy', 'Niue', 'Netherlands', 'Myanmar (Burma)', 'Qatar', 'AS', 'Bosnia  Herzegovina', 'Guinea', 'Slovenia', 'Jersey', 'Montenegro', 'Caribbean Netherlands', 'Paraguay', 'Indonesia', 'Dominican Republic', 'Bangladesh', 'Taiwan', 'Kyrgyzstan', 'Argentina'}

"""
import json
import pandas as pd
import random
from sys import argv

ERROR_MSG_ARG = "Invalid country name!"

def randomAddress(country):
    info = {}

    inFile = r"app/address_db.txt"
    df = pd.read_csv(inFile, encoding='utf-8', sep='|', usecols=['country','address', 'phoneNumber'])

    records = df.loc[df['country'] == country]
    randNum = random.randint(0,len(records))
    info['address'] = records.iloc[randNum]['address']
    info['phone'] = records.iloc[randNum]['phoneNumber']

    return info

if __name__ == "__main__":
    if len(argv) == 2:
        print(main(argv[1]))
    else:
        print(ERROR_MSG_ARG)