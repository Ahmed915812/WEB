from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app) # This allows your website to talk to the Python script

# This is your "Knowledge Base" in Python
scout_data = {
    "shirt": "The official Scout T-shirt is 12$. It's made of sustainable cotton.",
    "pants": "Scout pants are 15$. They are water-resistant for hiking.",
    "jacket": "The heavy jacket is 16$. Perfect for winter camping.",
    "activities": "We offer Archery, First Aid, and Knot-tying sessions!"
}

@app.route('/chat', methods=['POST'])
def chat_response():
    user_data = request.json
    user_message = user_data.get("message", "").lower()

    # Search the dictionary for a match
    response = "I'm not sure about 그. Try asking about shirts, pants, or activities!"
    
    for key in scout_data:
        if key in user_message:
            response = scout_data[key]

    return jsonify({"reply": response})

if __name__ == '__main__':
    app.run(port=5000)