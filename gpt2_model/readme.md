GPT2 Text Generation
====================
Text can be generated in one category. The pipeline should be run for each category. 

### Environment
The project is developed in Google Colab. Make sure the GPU is active.

### Steps to run
1. Preprocessing is needed for the language model. Follow the instructions in **preprocessing_GPT2_txtfiles.ipynb**. The output txt file will be used while fine-tuning the pre-trained model. 
2. Install transformers
```bash
!pip install -q transformers==3.4.0
```
3. Specify the paths of training, validation files and output directory for the trained model
```bash
OUTPUT_DIR="/content/gdrive/MyDrive/trainedModel"
TRAIN_FILE="/content/gdrive/MyDrive/trainFile.txt"
VALID_FILE="/content/gdrive/MyDrive/validFiletxt"
```
4. Fine-tune the model with training, run **run_language_modeling.py** with required arguments
```bash
!python /content/gdrive/MyDrive/Ens_data/GPT2_txtdata/run_language_modeling.py \
  --output_dir=$OUTPUT_DIR \
  --model_type=gpt2 \
  --model_name_or_path=gpt2 \
  --do_train \
  --train_data_file=$TRAIN_FILE \
  --do_eval \
  --eval_data_file=$VALID_FILE \
  --per_device_train_batch_size=2 \
  --per_device_eval_batch_size=2 \
  --line_by_line \
  --evaluate_during_training \
  --learning_rate 5e-5 \
  --num_train_epochs=5
```
5. Generate text data from fine-tuned model. Adjust category_name and save_path.
```bash
!python /content/gdrive/MyDrive/Ens_data/GPT2_txtdata/run_generation.py \
  --model_name_or_path $OUTPUT_DIR \
  --category_name entertainment \
  --length 400 \
  --num_return_sequences 150 \
  --save_path "/content/entertainment_gpt2.csv"
```
