import os
import uuid
import requests
import openai
import time
import base64

from openai import OpenAI
from fastapi import APIRouter, Form, Request
from dotenv import load_dotenv
from time import sleep
from openai import OpenAIError  # General error class
from tiktoken import encoding_for_model  # pip install tiktoken


# loads the keys from the file into the environment variables
load_dotenv()
CLIENT = OpenAI(api_key=os.getenv("OPENAI_API_KEY"))
# generates a random unique code
UNIQUE_ID = uuid.uuid4()


router = APIRouter()


async def count_tokens(text: str, model: str = "gpt-3.5-turbo") -> int:
    enc = encoding_for_model(model)
    return len(enc.encode(text))


@router.post("/create-blog-ai")
async def create_story(
    basic_idea: str = Form(...),
    genre: str = Form(...),
    story_length: int = Form(...),
    age_group: str = Form(None),
    banned_words: str = Form(None),
    banned_content: str = Form(None),
):

    # tokens = await count_tokens(my_instructions)
    # if tokens > 15000:
    #     print("Content quá dài, cần rút ngắn lại.")
    # my_instructions = my_instructions[:50000]  # hoặc dùng AI để tóm tắt

    # instructions for chatGPT
    # write_blog_article_instructions = f"""

    #     Bạn là một AI có tên là DUY để tạo ra một câu chuyện dựa trên thông tin sau:
    #     - Ý tưởng ban đầu: {basic_idea}
    #     - Thể loại truyện: {genre}
    #     - Độ dài mong muốn: khoảng {story_length} ký tự
    #     - Độ tuổi khán giả: {age_group if age_group else 'Mọi lứa tuổi'}
    #     - Từ ngữ bị cấm: {banned_words if banned_words else 'Không có'}
    #     - Nội dung bị cấm: {banned_content if banned_content else 'Không có'}

    #     2. Yêu cầu đầu ra:
    #     - Câu chuyện phải có đầy đủ MỞ ĐẦU – DIỄN BIẾN – CAO TRÀO – KẾT THÚC, phù hợp với Thể loại
    #     - Ngôn ngữ trong sáng, giàu hình ảnh, giọng kể kỳ ảo, cảm xúc sâu lắng
    #     - Hạn chế hội thoại, không cần giải thích chi tiết phép thuật
    #     - **Định dạng bắt buộc**:
    #         ```
    #         <TIEUDE>…</TIEUDE>
    #         <NOIDUNG>…</NOIDUNG>
    #         ```
    #     - Độ dài: đúng bằng (khoảng) Story Length do người dùng yêu cầu

    #     3. Tuyệt đối cấm:
    #     - Mô tả bạo lực máu me chi tiết
    #     - Tình dục, gợi dục, hành vi nhạy cảm
    #     - Phân biệt chủng tộc, kỳ thị giới tính, chính trị cực đoan
    #     - Ngôn từ tục tĩu, khiêu khích, giật gân phản cảm

    #     4. Quy trình tích hợp:
    #     - Hiển thị 1 page đơn giản để người dùng nhập các trường:
    #         * Basic Idea, Genre, Story Length, (tùy chọn) Age, Banned Words, Banned Content
    #     - Tạo tài khoản OpenAI GPT‑3.5+ (dùng email cá nhân)
    #     - Gọi API OpenAI để generate câu chuyện theo đúng template trên
    #     - Kiểm tra và đánh giá nội dung trả về
    #     - Xuất kết quả và hiển thị cho người dùng

    #     Hãy bắt đầu tạo truyện ngay!
    # """
    write_blog_article_instructions = f"""
        Bạn là một nhà báo chuyên nghiệp, hãy viết một bài tin tức/blog bài chất lượng cao với các yêu cầu sau:

        1. Tiêu đề (Headline):
        - Ngắn gọn, hấp dẫn (5–10 từ).
        - Chứa từ khóa chính của bài.

        2. Mở đầu (Lead Paragraph):
        - Tóm tắt “5W1H” (Who, What, When, Where, Why, How) trong 2–3 câu đầu.
        - Kích thích sự tò mò của người đọc.

        3. Thân bài (Body):
        - Sử dụng tiêu đề phụ (subheadings) để chia nhỏ nội dung.
        - Đưa vào tối thiểu 1 trích dẫn (quote) từ nhân vật liên quan hoặc chuyên gia.
        - Cung cấp số liệu, thống kê hoặc ví dụ minh hoạ cụ thể.
        - Đảm bảo câu văn ngắn gọn, dễ hiểu, giọng điệu khách quan.

        4. Bối cảnh & Phân tích:
        - Giải thích bối cảnh sự kiện/nội dung.
        - Đưa ra phân tích, nêu ra tác động, xu hướng hoặc dự báo nếu có.

        5. Kết bài (Conclusion):
        - Tổng hợp lại vấn đề chính.
        - Nêu kêu gọi hành động (CTA) nếu phù hợp (ví dụ: “Theo dõi chúng tôi để cập nhật…”).

        6. Yêu cầu bổ sung:
        - Chèn tối thiểu 2–3 từ khóa SEO tự nhiên xuyên suốt bài.
        - Cuối bài thêm phần “Nguồn tham khảo” (nếu lấy số liệu, trích dẫn).

        Thông tin bổ sung từ người dùng:
        - Ý tưởng ban đầu: {basic_idea}
        - Thể loại truyện/loại bài: {genre}
        - Số từ câu chuyện:{story_length or '2000'}
        - Độ tuổi khán giả: {age_group or 'Mọi lứa tuổi'}
        - Từ ngữ bị cấm: {banned_words or 'Không có'}
        - Nội dung bị cấm: {banned_content or 'Không có'}
        
        
        
       
        
        
           Please write a blog article on the topic provided in the text below. The blog post should be around 4000 characters long and cover all the most important points from the material provided. You are a knowledgeable expert in the field, so please write in a professional tone, but make sure to keep it engaging, fun, and easy to read.

        Use markdown formatting to structure the article with headings, bullet points, numbered lists, and other markdown features where appropriate. Make sure you only return the article in valid markdown format and do not include introduction statements that are not part of the article like "sure I can help you, here is the article:".


        Do not use ```markdown code blocks``` in the article or anywhere in your response, I know that the response will be markdown, so you do not have to indicate that.


         **Chỉ xuất kết quả dưới dạng sau – không kèm bất kỳ lời giải thích nào:
        <TIEUDE>...</TIEUDE>  
        <NOIDUNG>...</NOIDUNG>
        **
        

        REPLY IN VIETNAMESE LANGUAGE, DO NOT REPLY IN ENGLISH.

        """
    try:
        # Tạo câu chuyện bằng OpenAI
        response = CLIENT.chat.completions.create(
            model="gpt-3.5-turbo",
            messages=[
                {
                    "role": "system",
                    "content": "Bạn là một trợ lý viết blog tin tức chuyên nghiệp.",
                },
                {"role": "user", "content": write_blog_article_instructions},
            ],
        )
        story = response.choices[0].message.content

        # Tạo thư mục lưu trữ
        output_folder = f"output/{UNIQUE_ID}"
        if not os.path.exists(output_folder):
            os.makedirs(output_folder)

        # Lưu câu chuyện vào file markdown
        blog_article_save_location = f"{output_folder}/article.md"
        with open(blog_article_save_location, "w", encoding="utf-8") as file:
            file.write(story)
        print(f"Article saved as {blog_article_save_location}")

        print(f"Đang bắt đầu tóm tắt nội dung tạo ảnh")
        
        # Tóm tắt nội dung trước khi tạo ảnh
        summary_prompt =  CLIENT.chat.completions.create(
        model="gpt-3.5-turbo",
        messages=[
                {"role": "system", "content": "Tóm tắt ngắn nội dung sau thành 1-2 câu mô tả hình ảnh minh họa. DƯỚI 200 KÍ TỰ"},
                {"role": "user", "content": story}
            ],
        )
        
        image_prompt = summary_prompt.choices[0].message.content.strip()
        print(f"Nội dung để tạo ảnh: {image_prompt}")


        # Trích xuất tiêu đề làm prompt cho hình ảnh
        # title_start = story.find("<TIEUDE>") + len("<TIEUDE>")
        # title_end = story.find("</TIEUDE>")
        # image_prompt = (
        #     story[title_start:title_end].strip()
        #     if title_start > len("<TIEUDE>") and title_end != -1
        #     else "Một hình ảnh minh họa cho câu chuyện"
        # )
        
        # image_prompt = [
        #     {"role": "system", "content": "Tạo hình ảnh minh họa cho câu chuyện"},
        #     {"role": "user",   "content": story}
        # ]
        
        
        # print(f"Generating image with prompt: {image_prompt}")

        # Tạo hình ảnh bằng DALL-E
        max_attempts = 3
        for attempt in range(max_attempts):
            try:
                dalle_response = CLIENT.images.generate(
                    prompt=image_prompt,
                    model="dall-e-2",
                    response_format="url",
                    size="1024x1024",
                    n=1,
                )
                image_url = dalle_response.data[0].url

                image_path = f"{output_folder}/image.png"

                resp = requests.get(image_url)
                # with open(f"{output_folder}/image.png", "wb") as f:
                #     f.write(resp.content)
                with open(image_path, "wb") as img_file:
                    img_file.write(resp.content)
                print(f"Image saved as {image_path}")

                print(f"Image saved as {output_folder}/image.png")
                print("Image URL:", image_url)
                break
            except openai.RateLimitError as e:
                if attempt < max_attempts - 1:
                    print(
                        f"Rate limit exceeded. Waiting 60 seconds before retry {attempt + 1}/{max_attempts}..."
                    )
                    time.sleep(60)
                else:
                    print(
                        "Max retry attempts reached. Please try again later or check your rate limits."
                    )
                    raise

        return {"story": story, "image_url": image_url}

    except OpenAIError as e:
        print(f"An error occurred: {str(e)}")
    return {"error": str(e)}
