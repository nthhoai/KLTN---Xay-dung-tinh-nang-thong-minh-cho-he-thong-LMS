import pickle
from flask import Flask, request, jsonify
from flask_cors import CORS
import numpy as np



app = Flask(__name__)
CORS(app)
@app.route('/predict', methods=['POST'])
def post():
    file_path = "./system/model_mlp.pkl"
    with open(file_path, "rb") as f:
        model = pickle.load(f)
    data = request.get_json()
    input_data = data["data"]
    input_data = np.array([input_data])  
    y_predict = model.predict(input_data)
    message = y_predict[0]
    response = jsonify({ "Kết quả": message })
    response.headers["Access-Control-Allow-Origin"] = "*"
    if y_predict == 0:
        message = "Không phê duyệt"
        response = jsonify({ "Kết quả": message })    
    return response



if __name__ == '__main__':
    app.run(debug="True", host='0.0.0.0', port=5000)



